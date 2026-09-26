<?php

namespace App\Observers;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class AffectationObserver
{
    public function created(AffectationModel $affectation): void
    {
        // Créer session automatique
        $exists = SessionModel::where('formateur_id', $affectation->formateur_id)->exists();

        if (!$exists) {
            $formateur = FormateurModel::find($affectation->formateur_id);

            SessionModel::create([
                'code'             => SessionModel::generateNextCode(),
                'titre'            => 'Session ' . ($affectation->filiere->libelle ?? 'Formation'),
                'formateur_id'     => $affectation->formateur_id,
                'filiere_id'       => $affectation->filiere_id,
                'etablissement_id' => $affectation->etablissement_id,
                'date_debut'       => $affectation->date_debut,
                'date_fin'         => $affectation->date_fin ?? now()->addMonths(6),
                'nb_places'        => 0,
                'statut'           => $formateur->statut ?? SessionModel::STATUT_ACTIF,
            ]);
        }
    }

    public function updated(AffectationModel $affectation): void
    {
        // Synchroniser la session
        $session = SessionModel::where('formateur_id', $affectation->formateur_id)->latest()->first();

        if ($session) {
            $session->update([
                'date_debut' => $affectation->date_debut,
                'date_fin'   => $affectation->date_fin,
                'statut'     => $affectation->statut,
            ]);
        }
    }

    public function deleted(AffectationModel $affectation): void
    {
        SessionModel::where('formateur_id', $affectation->formateur_id)->delete();
    }
}