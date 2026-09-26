<?php

namespace Tests\Unit\Domain\Formateurs\ValueObjects;

use Domain\Formateurs\ValueObjects\Telephone;
use InvalidArgumentException;
use Tests\TestCase;

class TelephoneTest extends TestCase
{
    public function test_telephone_valide(): void
    {
        $tel = new Telephone('0341234567');
        $this->assertEquals('0341234567', $tel->getValue());
    }

    public function test_telephone_avec_espaces(): void
    {
        $tel = new Telephone('034 12 345 67');
        $this->assertEquals('0341234567', $tel->getValue());
    }

    public function test_telephone_avec_indicatif(): void
    {
        $tel = new Telephone('+261341234567');
        $this->assertEquals('+261341234567', $tel->getValue());
    }

    public function test_telephone_null(): void
    {
        $tel = new Telephone(null);
        $this->assertTrue($tel->isNull());
        $this->assertNull($tel->getValue());
    }

    public function test_telephone_vide_null(): void
    {
        $tel = new Telephone('');
        $this->assertTrue($tel->isNull());
    }

    public function test_telephone_trop_court_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Telephone('123');
    }

    public function test_format_madagascar(): void
    {
        $tel = new Telephone('0341234567');
        $this->assertEquals('034 12 345 67', $tel->getFormatted());
    }
}