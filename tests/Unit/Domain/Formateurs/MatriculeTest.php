<?php

namespace Tests\Unit\Domain\Formateurs;

use Domain\Formateurs\ValueObjects\Matricule;
use InvalidArgumentException;
use Tests\TestCase;

class MatriculeTest extends TestCase
{
    public function test_matricule_valide(): void
    {
        $matricule = new Matricule('FORM-001');
        $this->assertEquals('FORM-001', $matricule->getValue());
    }

    public function test_matricule_converti_en_majuscules(): void
    {
        $matricule = new Matricule('form-001');
        $this->assertEquals('FORM-001', $matricule->getValue());
    }

    public function test_matricule_vide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Matricule('');
    }

    public function test_matricule_trop_long_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Matricule(str_repeat('A', 51));
    }
}