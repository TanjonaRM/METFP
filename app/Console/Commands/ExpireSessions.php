<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class ExpireSessions extends Command
{
    protected $signature = 'sessions:expire';

    protected $description = 'Expire les sessions terminées et propage à toutes les entités liées';

    public function handle(): int
    {
        $today = now()->toDateString();

        // 1. Trouver les sessions actives expirées
        $sessionsExpirees = SessionModel::where('statut', SessionModel::STATUT_ACTIF)
            ->whereNotNull('date_fin')
            ->where('date_fin', '<', $today)
            ->get();

        $count = 0;

        foreach ($sessionsExpirees as $session) {
            // 2. Session -> inactif
            $session->update([
                'statut'    => SessionModel::STATUT_INACTIF,
                'expire_le' => now(),
            ]);

            // 3. Formateur -> inactif (source de vérité)
            //    -> l'Observer FormateurObserver va propager à affectation, établissement, filière
            if ($session->formateur) {
                $session->formateur->update(['statut' => FormateurModel::STATUT_INACTIF]);
            }

            $count++;
        }

        $this->info("[OK] {$count} session(s) expirée(s).");

        return self::SUCCESS;
    }
}