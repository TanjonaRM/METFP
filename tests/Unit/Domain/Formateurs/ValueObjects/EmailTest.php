<?php

namespace Tests\Unit\Domain\Formateurs\ValueObjects;

use Domain\Formateurs\ValueObjects\Email;
use InvalidArgumentException;
use Tests\TestCase;

class EmailTest extends TestCase
{
    public function test_email_valide(): void
    {
        $email = new Email('test@metfp.mg');
        $this->assertEquals('test@metfp.mg', $email->getValue());
    }

    public function test_email_converti_en_minuscules(): void
    {
        $email = new Email('TEST@METFP.MG');
        $this->assertEquals('test@metfp.mg', $email->getValue());
    }

    public function test_email_espaces_supprimes(): void
    {
        $email = new Email('  test@metfp.mg  ');
        $this->assertEquals('test@metfp.mg', $email->getValue());
    }

    public function test_email_vide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('');
    }

    public function test_email_invalide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('pas-un-email');
    }

    public function test_get_domain(): void
    {
        $email = new Email('test@metfp.mg');
        $this->assertEquals('metfp.mg', $email->getDomain());
    }

    public function test_equals(): void
    {
        $email1 = new Email('test@metfp.mg');
        $email2 = new Email('test@metfp.mg');
        $email3 = new Email('autre@metfp.mg');

        $this->assertTrue($email1->equals($email2));
        $this->assertFalse($email1->equals($email3));
    }

    public function test_tostring(): void
    {
        $email = new Email('test@metfp.mg');
        $this->assertEquals('test@metfp.mg', (string) $email);
    }
}