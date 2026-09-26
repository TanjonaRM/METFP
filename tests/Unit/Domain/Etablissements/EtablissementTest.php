<?php

namespace Tests\Unit\Domain\Etablissements;

use Domain\Etablissements\Entities\Etablissement;
use Tests\TestCase;

class EtablissementTest extends TestCase
{
    public function test_get_nom_complet(): void
    {
        $etablissement = new Etablissement(
            id: 1,
            code: 'CFP-AMBILOBE',
            nom: 'CFP AMBILOBE',
            type: 'CFP',
        );

        $this->assertEquals('CFP AMBILOBE', $etablissement->getNomComplet());
    }

    public function test_est_cfp(): void
    {
        $etablissement = new Etablissement(
            id: 1,
            code: 'CFP-AMBILOBE',
            nom: 'CFP AMBILOBE',
            type: 'CFP',
        );

        $this->assertTrue($etablissement->estCFP());
        $this->assertFalse($etablissement->estLTP());
    }

    public function test_est_ltp(): void
    {
        $etablissement = new Etablissement(
            id: 1,
            code: 'LTP-MAHAMASINA',
            nom: 'LTP MAHAMASINA',
            type: 'LTP',
        );

        $this->assertTrue($etablissement->estLTP());
        $this->assertFalse($etablissement->estCFP());
    }
}