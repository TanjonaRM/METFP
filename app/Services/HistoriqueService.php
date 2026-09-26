<?php

namespace App\Services;

use Infrastructure\Persistence\Eloquent\Models\HistoriqueFormateurModel;

class HistoriqueService
{
    /**
     * Enregistre un changement d'affectation
     */
    public static function affectation(
        int $formateurId,
        ?string $etablissementAvant,
        ?string $etablissementApres,
        ?string $filiereAvant,
        ?string $filiereApres,
        ?int $affectationId = null,
        ?string $source = 'admin'
    ): void {
        // Changement établissement
        if ($etablissementAvant !== $etablissementApres) {
            HistoriqueFormateurModel::create([
                'formateur_id'   => $formateurId,
                'type'           => HistoriqueFormateurModel::TYPE_ETABLISSEMENT,
                'entite_type'    => 'Etablissement',
                'valeur_avant'   => $etablissementAvant,
                'valeur_apres'   => $etablissementApres,
                'survenu_le'     => now(),
                'source'         => $source,
            ]);
        }

        // Changement filière
        if ($filiereAvant !== $filiereApres) {
            HistoriqueFormateurModel::create([
                'formateur_id'   => $formateurId,
                'type'           => HistoriqueFormateurModel::TYPE_FILIERE,
                'entite_type'    => 'Filiere',
                'valeur_avant'   => $filiereAvant,
                'valeur_apres'   => $filiereApres,
                'survenu_le'     => now(),
                'source'         => $source,
            ]);
        }

        // Affectation créée
        HistoriqueFormateurModel::create([
            'formateur_id'   => $formateurId,
            'type'           => HistoriqueFormateurModel::TYPE_AFFECTATION,
            'entite_type'    => 'Affectation',
            'entite_id'      => $affectationId,
            'valeur_apres'   => ($filiereApres ?? '-') . ' à ' . ($etablissementApres ?? '-'),
            'survenu_le'     => now(),
            'source'         => $source,
        ]);
    }

    /**
     * Enregistre la création d'une session
     */
    public static function session(
        int $formateurId,
        string $codeSession,
        ?string $titre,
        ?string $filiere,
        ?string $etablissement,
        ?int $sessionId = null,
        ?string $source = 'admin'
    ): void {
        HistoriqueFormateurModel::create([
            'formateur_id'   => $formateurId,
            'type'           => HistoriqueFormateurModel::TYPE_SESSION,
            'entite_type'    => 'Session',
            'entite_id'      => $sessionId,
            'valeur_apres'   => $codeSession . ($titre ? ' - ' . $titre : ''),
            'details'        => [
                'code'          => $codeSession,
                'titre'         => $titre,
                'filiere'       => $filiere,
                'etablissement' => $etablissement,
            ],
            'survenu_le'     => now(),
            'source'         => $source,
        ]);
    }

    /**
     * Enregistre un changement de statut
     */
    public static function statut(
        int $formateurId,
        string $statutAvant,
        string $statutApres,
        ?string $source = 'system'
    ): void {
        HistoriqueFormateurModel::create([
            'formateur_id'   => $formateurId,
            'type'           => HistoriqueFormateurModel::TYPE_STATUT,
            'valeur_avant'   => $statutAvant,
            'valeur_apres'   => $statutApres,
            'survenu_le'     => now(),
            'source'         => $source,
        ]);
    }
}