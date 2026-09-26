<?php

namespace Tests\Unit\Domain\Filieres;

use Domain\Filieres\Entities\Filiere;
use Tests\TestCase;

class FiliereTest extends TestCase
{
    public function test_get_libelle_complet(): void
    {
        $filiere = new Filiere(
            id: 1,
            code: 'TPFM',
            libelle: 'Technicien productique en fabrication mécanique',
            niveauId: 1,
            secteurId: 1,
        );

        $this->assertEquals(
            'Technicien productique en fabrication mécanique',
            $filiere->getLibelleComplet()
        );
    }

    public function test_a_des_options(): void
    {
        $filiere = new Filiere(
            id: 1,
            code: 'TMEL',
            libelle: 'Technicien en électrotechnique',
            niveauId: 1,
            secteurId: 1,
            options: ['énergie renouvelable'],
        );

        $this->assertTrue($filiere->aDesOptions());
        $this->assertCount(1, $filiere->getOptions());
    }
}