<?php

namespace Tests\Unit\Domain\Affectations;

use Domain\Affectations\Entities\Affectation;
use Tests\TestCase;

class AffectationTest extends TestCase
{
    public function test_est_active(): void
    {
        $affectation = new Affectation(
            id: 1,
            formateurId: 1,
            filiereId: 1,
            etablissementId: 1,
            dateDebut: now(),
            statut: 'actif',
        );

        $this->assertTrue($affectation->estActive());
    }

    public function test_est_terminee(): void
    {
        $affectation = new Affectation(
            id: 1,
            formateurId: 1,
            filiereId: 1,
            etablissementId: 1,
            dateDebut: now()->subMonths(6),
            dateFin: now(),
            statut: 'termine',
        );

        $this->assertTrue($affectation->estTerminee());
        $this->assertFalse($affectation->estActive());
    }

    public function test_calcul_duree(): void
    {
        $affectation = new Affectation(
            id: 1,
            formateurId: 1,
            filiereId: 1,
            etablissementId: 1,
            dateDebut: now(),
            dateFin: now()->addDays(30),
            statut: 'actif',
        );

        $this->assertEquals(30, $affectation->getDureeEnJours());
    }
}