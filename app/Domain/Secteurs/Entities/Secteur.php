<?php

namespace Domain\Secteurs\Entities;

class Secteur
{
    public function __construct(
        public ?int $id,
        public string $code,
        public string $libelle,
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function estIndustriel(): bool
    {
        return $this->code === 'IND';
    }

    public function estGenieCivil(): bool
    {
        return $this->code === 'GC';
    }

    public function estTertiaire(): bool
    {
        return $this->code === 'TER';
    }

    public function estAgricole(): bool
    {
        return $this->code === 'AGR';
    }

    public function estTourisme(): bool
    {
        return $this->code === 'THR';
    }

    public function estTha(): bool
    {
        return $this->code === 'THA';
    }

    public function estTic(): bool
    {
        return $this->code === 'TIC';
    }
}