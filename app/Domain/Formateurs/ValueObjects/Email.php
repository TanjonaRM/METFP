<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim(strtolower($value));

        if (empty($value)) {
            throw new InvalidArgumentException("L'email ne peut pas être vide.");
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("L'email '{$value}' n'est pas valide.");
        }

        if (strlen($value) > 255) {
            throw new InvalidArgumentException("L'email ne peut pas dépasser 255 caractères.");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getDomain(): string
    {
        return substr(strrchr($this->value, "@"), 1);
    }

    public function equals(Email $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}