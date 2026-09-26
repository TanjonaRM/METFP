<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class Matricule
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException("Le matricule ne peut pas être vide.");
        }
        if (strlen($value) > 50) {
            throw new InvalidArgumentException("Le matricule ne peut pas dépasser 50 caractères.");
        }
        $this->value = strtoupper(trim($value));
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Matricule $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}