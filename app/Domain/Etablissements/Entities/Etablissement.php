<?php

namespace Domain\Etablissements\Entities;

class Etablissement
{
    public function __construct(
        public ?int $id,
        public string $code,
        public string $nom,
        public string $type = 'CFP',
        public ?string $region = null,
        public ?string $adresse = null,
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom;
    }

    public function estCFP(): bool
    {
        return $this->type === 'CFP';
    }

    public function estLTP(): bool
    {
        return $this->type === 'LTP';
    }

    public function estLycee(): bool
    {
        return $this->type === 'Lycee';
    }
}