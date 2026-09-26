<?php

namespace Tests\Unit\Domain\Niveaux;

use Domain\Niveaux\Entities\Niveau;
use Tests\TestCase;

class NiveauTest extends TestCase
{
    public function test_code_valide(): void
    {
        $niveau = new Niveau(
            id: 1,
            code: 'BAC',
            libelle: 'Baccalauréat Technologique',
        );

        $this->assertEquals('BAC', $niveau->getCode());
    }

    public function test_est_bac(): void
    {
        $niveau = new Niveau(id: 1, code: 'BAC', libelle: 'Baccalauréat');
        $this->assertTrue($niveau->estBac());
    }

    public function test_est_cap(): void
    {
        $niveau = new Niveau(id: 3, code: 'CAP', libelle: 'CAP');
        $this->assertTrue($niveau->estCap());
        $this->assertFalse($niveau->estBac());
    }
}