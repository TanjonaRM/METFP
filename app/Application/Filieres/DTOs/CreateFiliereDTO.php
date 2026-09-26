<?php

namespace Application\Filieres\DTOs;

class CreateFiliereDTO
{
    public function __construct(
        public string $code,
        public string $libelle,
        public int $niveauId,
        public int $secteurId,
        public ?string $description = null,
        public array $options = [],
    ) {}

    public static function fromArray(array $data, array $options = []): self
    {
        return new self(
            code: $data['code'],
            libelle: $data['libelle'],
            niveauId: (int) $data['niveau_id'],
            secteurId: (int) $data['secteur_id'],
            description: $data['description'] ?? null,
            options: $options,
        );
    }
}