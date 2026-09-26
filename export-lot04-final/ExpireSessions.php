<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class ExpireSessions extends Command
{
    protected $signature = 'sessions:expire';

    protected $description = 'Expire les sessions terminées et synchronise formateurs + affectations';

    public function handle(): int
    {
        $today = now()->toDateString();

        DB::beginTransaction();

        try {
            // 1. Récupérer les sessions actives expirées
            $sessionsExpirees = SessionModel::where('statut', SessionModel::STATUT_ACTIVE)
                ->whereNotNull('date_fin')
                ->where('date_fin', '<', $today)
                ->get();

            $count = 0;
            $formateursTouches = [];

            foreach ($sessionsExpirees as $session) {
                // a. Session → terminee
                $session->update([
                    'statut'    => SessionModel::STATUT_TERMINEE,
                    'expire_le' => now(),
                ]);

                // b. Affectation liée → termine (si elle était active)
                AffectationModel::where('formateur_id', $session->formateur_id)
                    ->where('filiere_id', $session->filiere_id)
                    ->where('etablissement_id', $session->etablissement_id)
                    ->where('statut', AffectationModel::STATUT_ACTIF)
                    ->update(['statut' => AffectationModel::STATUT_TERMINE]);

                if ($session->formateur_id) {
                    $formateursTouches[$session->formateur_id] = true;
                }

                $count++;
            }

            // 2. Recalculer le statut de chaque formateur touché
            foreach (array_keys($formateursTouches) as $formateurId) {
                $formateur = \Infrastructure\Persistence\Eloquent\Models\FormateurModel::find($formateurId);
                if ($formateur) {
                    $formateur->recalculerStatut();
                }
            }

            DB::commit();

            $this->info("✅ {$count} session(s) expirée(s).");
            $this->info("✅ " . count($formateursTouches) . " formateur(s) recalculé(s).");

            return self::SUCCESS;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ Erreur : " . $e->getMessage());
            return self::FAILURE;
        }
    }
}