<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class Statut
{
    public const ACTIF = 'actif';
    public const INACTIF = 'inactif';
    public const EN_ATTENTE = 'en_attente';

    private const STATUTS_VALIDES = [
        self::ACTIF,
        self::INACTIF,
        self::EN_ATTENTE,
    ];

    private string $value;

    public function __construct(string $value)
    {
        $value = strtolower(trim($value));

        if (!in_array($value, self::STATUTS_VALIDES, true)) {
            throw new InvalidArgumentException(
                "Le statut '{$value}' n'est pas valide. Valeurs autorisées : "
                . implode(', ', self::STATUTS_VALIDES)
            );
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function estActif(): bool
    {
        return $this->value === self::ACTIF;
    }

    public function estInactif(): bool
    {
        return $this->value === self::INACTIF;
    }

    public function estEnAttente(): bool
    {
        return $this->value === self::EN_ATTENTE;
    }

    public function getLabel(): string
    {
        return match ($this->value) {
            self::ACTIF => 'Actif',
            self::INACTIF => 'Inactif',
            self::EN_ATTENTE => 'En attente',
            default => 'Inconnu',
        };
    }

    public static function actif(): self
    {
        return new self(self::ACTIF);
    }

    public static function inactif(): self
    {
        return new self(self::INACTIF);
    }

    public static function enAttente(): self
    {
        return new self(self::EN_ATTENTE);
    }

    public function equals(Statut $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}