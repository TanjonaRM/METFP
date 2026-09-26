<?php

namespace Domain\Niveaux\Entities;

class Niveau
{
    public function __construct(
        public ?int $id,
        public string $code,
        public string $libelle,
        public ?string $description = null,
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function estBac(): bool
    {
        return $this->code === 'BAC';
    }

    public function estBep(): bool
    {
        return $this->code === 'BEP';
    }

    public function estCap(): bool
    {
        return $this->code === 'CAP';
    }

    public function estCfa(): bool
    {
        return $this->code === 'CFA';
    }

    public function estCaps(): bool
    {
        return $this->code === 'CAPS';
    }
}