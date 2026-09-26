<?php

namespace Tests\Unit\Domain\Formateurs\Exceptions;

use Domain\Formateurs\Exceptions\FormateurInvalideException;
use Tests\TestCase;

class FormateurInvalideExceptionTest extends TestCase
{
    public function test_email_invalide(): void
    {
        $e = FormateurInvalideException::emailInvalide('bad-email');
        $this->assertStringContainsString('bad-email', $e->getMessage());
    }

    public function test_matricule_invalide(): void
    {
        $e = FormateurInvalideException::matriculeInvalide('BAD');
        $this->assertStringContainsString('BAD', $e->getMessage());
        $this->assertStringContainsString('FORM-XXX', $e->getMessage());
    }

    public function test_nom_vide(): void
    {
        $e = FormateurInvalideException::nomVide();
        $this->assertStringContainsString('nom', $e->getMessage());
    }

    public function test_prenom_vide(): void
    {
        $e = FormateurInvalideException::prenomVide();
        $this->assertStringContainsString('prénom', $e->getMessage());
    }

    public function test_telephone_invalide(): void
    {
        $e = FormateurInvalideException::telephoneInvalide('123');
        $this->assertStringContainsString('123', $e->getMessage());
    }
}