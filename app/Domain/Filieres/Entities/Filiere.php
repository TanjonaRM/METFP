<?php

namespace Domain\Filieres\Entities;

class Filiere
{
    public function __construct(
        public ?int $id,
        public string $code,
        public string $libelle,
        public ?int $niveauId = null,
        public ?int $secteurId = null,
        public ?string $description = null,
        public array $options = [],
    ) {}

    public function getLibelleComplet(): string
    {
        return $this->libelle;
    }

    public function aDesOptions(): bool
    {
        return count($this->options) > 0;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}