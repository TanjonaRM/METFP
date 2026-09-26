<?php

namespace Tests\Unit\Domain\Formateurs\ValueObjects;

use Domain\Formateurs\ValueObjects\NomComplet;
use InvalidArgumentException;
use Tests\TestCase;

class NomCompletTest extends TestCase
{
    public function test_nom_complet_valide(): void
    {
        $nc = new NomComplet('Rakoto', 'Jean');
        $this->assertEquals('Rakoto', $nc->getNom());
        $this->assertEquals('Jean', $nc->getPrenom());
    }

    public function test_format_prenom_nom(): void
    {
        $nc = new NomComplet('Rakoto', 'Jean');
        $this->assertEquals('Jean Rakoto', $nc->getFormatted());
    }

    public function test_format_nom_majuscule(): void
    {
        $nc = new NomComplet('Rakoto', 'Jean');
        $this->assertEquals('RAKOTO Jean', $nc->getFormattedAvecNomMajuscule());
    }

    public function test_initiales(): void
    {
        $nc = new NomComplet('Rakoto', 'Jean');
        $this->assertEquals('JR', $nc->getInitiales());
    }

    public function test_ucfirst(): void
    {
        $nc = new NomComplet('RAKOTO', 'JEAN');
        $this->assertEquals('Rakoto', $nc->getNom());
        $this->assertEquals('Jean', $nc->getPrenom());
    }

    public function test_nom_vide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new NomComplet('', 'Jean');
    }

    public function test_prenom_vide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new NomComplet('Rakoto', '');
    }

    public function test_equals(): void
    {
        $a = new NomComplet('Rakoto', 'Jean');
        $b = new NomComplet('Rakoto', 'Jean');
        $c = new NomComplet('Rasoa', 'Marie');

        $this->assertTrue($a->equals($b));
        $this->assertFalse($a->equals($c));
    }
}