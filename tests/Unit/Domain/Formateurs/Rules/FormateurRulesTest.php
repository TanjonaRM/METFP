<?php

namespace Tests\Unit\Domain\Formateurs\Rules;

use Domain\Formateurs\Rules\FormateurRules;
use Tests\TestCase;

class FormateurRulesTest extends TestCase
{
    // ===== MATRICULE =====
    public function test_matricule_valide(): void
    {
        $this->assertTrue(FormateurRules::validerMatricule('FORM-001'));
        $this->assertTrue(FormateurRules::validerMatricule('FORM-1234'));
    }

    public function test_matricule_invalide(): void
    {
        $this->assertFalse(FormateurRules::validerMatricule('FORM-1'));
        $this->assertFalse(FormateurRules::validerMatricule('FORM'));
        $this->assertFalse(FormateurRules::validerMatricule('form-001'));
        $this->assertFalse(FormateurRules::validerMatricule(''));
    }

    // ===== EMAIL =====
    public function test_email_valide(): void
    {
        $this->assertTrue(FormateurRules::validerEmail('test@metfp.mg'));
        $this->assertTrue(FormateurRules::validerEmail('user.name@example.com'));
    }

    public function test_email_invalide(): void
    {
        $this->assertFalse(FormateurRules::validerEmail('pas-un-email'));
        $this->assertFalse(FormateurRules::validerEmail('@example.com'));
        $this->assertFalse(FormateurRules::validerEmail(''));
    }

    // ===== TELEPHONE =====
    public function test_telephone_valide(): void
    {
        $this->assertTrue(FormateurRules::validerTelephone('0341234567'));
        $this->assertTrue(FormateurRules::validerTelephone('+261341234567'));
        $this->assertTrue(FormateurRules::validerTelephone(null));
        $this->assertTrue(FormateurRules::validerTelephone(''));
    }

    public function test_telephone_invalide(): void
    {
        $this->assertFalse(FormateurRules::validerTelephone('123'));
    }

    // ===== STATUT =====
    public function test_statut_valide(): void
    {
        $this->assertTrue(FormateurRules::validerStatut('actif'));
        $this->assertTrue(FormateurRules::validerStatut('inactif'));
        $this->assertTrue(FormateurRules::validerStatut('en_attente'));
    }

    public function test_statut_invalide(): void
    {
        $this->assertFalse(FormateurRules::validerStatut('invalide'));
        $this->assertFalse(FormateurRules::validerStatut(''));
    }

    // ===== VALIDATION COMPLÈTE =====
    public function test_valider_retourne_vide_si_tout_ok(): void
    {
        $erreurs = FormateurRules::valider([
            'matricule' => 'FORM-001',
            'email' => 'test@metfp.mg',
            'nom' => 'Rakoto',
            'prenom' => 'Jean',
            'telephone' => '0341234567',
            'statut' => 'actif',
        ]);

        $this->assertEmpty($erreurs);
    }

    public function test_valider_retourne_erreurs(): void
    {
        $erreurs = FormateurRules::valider([
            'matricule' => 'BAD',
            'email' => 'pas-un-email',
            'nom' => '',
        ]);

        $this->assertArrayHasKey('matricule', $erreurs);
        $this->assertArrayHasKey('email', $erreurs);
        $this->assertArrayHasKey('nom', $erreurs);
    }
}