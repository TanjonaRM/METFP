<?php

namespace Tests\Unit\Domain\Sessions;

use Domain\Sessions\Entities\Session;
use Tests\TestCase;

class SessionTest extends TestCase
{
    public function test_code_valide(): void
    {
        $session = new Session(
            id: 1,
            code: 'SESS-2026-001',
            filiereId: 1,
            formateurId: 1,
            etablissementId: 1,
            dateDebut: now(),
            dateFin: now()->addMonths(3),
            nbPlaces: 20,
        );

        $this->assertEquals('SESS-2026-001', $session->getCode());
    }

    public function test_est_en_cours(): void
    {
        $session = new Session(
            id: 1,
            code: 'SESS-001',
            filiereId: 1,
            formateurId: 1,
            etablissementId: 1,
            dateDebut: now()->subDays(15),
            dateFin: now()->addDays(15),
            nbPlaces: 20,
        );

        $this->assertTrue($session->estEnCours());
    }

    public function test_est_terminee(): void
    {
        $session = new Session(
            id: 1,
            code: 'SESS-001',
            filiereId: 1,
            formateurId: 1,
            etablissementId: 1,
            dateDebut: now()->subMonths(3),
            dateFin: now()->subDays(1),
            nbPlaces: 20,
        );

        $this->assertTrue($session->estTerminee());
    }
}