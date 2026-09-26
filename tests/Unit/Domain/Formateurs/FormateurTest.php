<?php

namespace Tests\Unit\Domain\Formateurs;

use Domain\Formateurs\Entities\Formateur;
use Tests\TestCase;

class FormateurTest extends TestCase
{
    public function test_get_nom_complet(): void
    {
        $formateur = new Formateur(
            id: 1,
            matricule: 'FORM-001',
            nom: 'Rakoto',
            prenom: 'Jean',
            email: 'jean@test.mg',
        );

        $this->assertEquals('Rakoto Jean', $formateur->getNomComplet());
    }

    public function test_est_actif(): void
    {
        $formateur = new Formateur(
            id: 1,
            matricule: 'FORM-001',
            nom: 'Rakoto',
            prenom: 'Jean',
            email: 'jean@test.mg',
            statut: 'actif',
        );

        $this->assertTrue($formateur->estActif());
    }

    public function test_est_inactif(): void
    {
        $formateur = new Formateur(
            id: 1,
            matricule: 'FORM-001',
            nom: 'Rakoto',
            prenom: 'Jean',
            email: 'jean@test.mg',
            statut: 'inactif',
        );

        $this->assertFalse($formateur->estActif());
    }
}