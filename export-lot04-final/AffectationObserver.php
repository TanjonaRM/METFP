<?php

namespace App\Observers;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class AffectationObserver
{
    public function created(AffectationModel $affectation): void
    {
        $exists = SessionModel::where('formateur_id', $affectation->formateur_id)
            ->where('filiere_id', $affectation->filiere_id)
            ->where('etablissement_id', $affectation->etablissement_id)
            ->where('date_debut', $affectation->date_debut)
            ->exists();

        if (!$exists) {
            SessionModel::create([
                'code'             => SessionModel::generateNextCode(),
                'titre'            => 'Session ' . ($affectation->filiere->libelle ?? 'Formation'),
                'formateur_id'     => $affectation->formateur_id,
                'filiere_id'       => $affectation->filiere_id,
                'etablissement_id' => $affectation->etablissement_id,
                'date_debut'       => $affectation->date_debut,
                'date_fin'         => $affectation->date_fin ?? now()->addMonths(6),
                'nb_places'        => 0,
                'statut'           => SessionModel::STATUT_ACTIVE,
            ]);
        }

        $formateur = FormateurModel::find($affectation->formateur_id);
        if ($formateur) {
            $formateur->recalculerStatut();
        }
    }

    public function updated(AffectationModel $affectation): void
    {
        $session = SessionModel::where('formateur_id', $affectation->formateur_id)
            ->where('filiere_id', $affectation->filiere_id)
            ->where('etablissement_id', $affectation->etablissement_id)
            ->latest()
            ->first();

        if ($session) {
            $statutSession = match ($affectation->statut) {
                AffectationModel::STATUT_ACTIF    => SessionModel::STATUT_ACTIVE,
                AffectationModel::STATUT_SUSPENDU => SessionModel::STATUT_SUSPENDU,
                AffectationModel::STATUT_TERMINE  => SessionModel::STATUT_TERMINEE,
                default                           => SessionModel::STATUT_ACTIVE,
            };

            $session->update([
                'date_debut' => $affectation->date_debut,
                'date_fin'   => $affectation->date_fin,
                'statut'     => $statutSession,
            ]);
        }

        $formateur = FormateurModel::find($affectation->formateur_id);
        if ($formateur) {
            $formateur->recalculerStatut();
        }
    }

    public function deleted(AffectationModel $affectation): void
    {
        SessionModel::where('formateur_id', $affectation->formateur_id)
            ->where('filiere_id', $affectation->filiere_id)
            ->where('etablissement_id', $affectation->etablissement_id)
            ->delete();

        $formateur = FormateurModel::find($affectation->formateur_id);
        if ($formateur) {
            $formateur->recalculerStatut();
        }
    }
}