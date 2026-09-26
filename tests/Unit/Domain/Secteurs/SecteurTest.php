<?php

namespace Tests\Unit\Domain\Secteurs;

use Domain\Secteurs\Entities\Secteur;
use Tests\TestCase;

class SecteurTest extends TestCase
{
    public function test_code_valide(): void
    {
        $secteur = new Secteur(
            id: 1,
            code: 'IND',
            libelle: 'INDUSTRIEL',
        );

        $this->assertEquals('IND', $secteur->getCode());
        $this->assertEquals('INDUSTRIEL', $secteur->getLibelle());
    }

    public function test_est_industriel(): void
    {
        $secteur = new Secteur(id: 1, code: 'IND', libelle: 'INDUSTRIEL');
        $this->assertTrue($secteur->estIndustriel());
    }
}