<?php

namespace Tests\Unit\Domain\Formateurs\ValueObjects;

use Domain\Formateurs\ValueObjects\Statut;
use InvalidArgumentException;
use Tests\TestCase;

class StatutTest extends TestCase
{
    public function test_statut_actif(): void
    {
        $statut = new Statut('actif');
        $this->assertTrue($statut->estActif());
        $this->assertFalse($statut->estInactif());
        $this->assertFalse($statut->estEnAttente());
    }

    public function test_statut_inactif(): void
    {
        $statut = new Statut('inactif');
        $this->assertTrue($statut->estInactif());
    }

    public function test_statut_en_attente(): void
    {
        $statut = new Statut('en_attente');
        $this->assertTrue($statut->estEnAttente());
    }

    public function test_statut_invalide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Statut('invalide');
    }

    public function test_constructeurs_statiques(): void
    {
        $this->assertTrue(Statut::actif()->estActif());
        $this->assertTrue(Statut::inactif()->estInactif());
        $this->assertTrue(Statut::enAttente()->estEnAttente());
    }

    public function test_get_label(): void
    {
        $this->assertEquals('Actif', Statut::actif()->getLabel());
        $this->assertEquals('Inactif', Statut::inactif()->getLabel());
        $this->assertEquals('En attente', Statut::enAttente()->getLabel());
    }
}