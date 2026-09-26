<?php

namespace Application\Niveaux\DTOs;

class UpdateNiveauDTO
{
    public function __construct(
        public int $id,
        public string $code,
        public string $libelle,
        public ?string $description = null,
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id: $id,
            code: $data['code'],
            libelle: $data['libelle'],
            description: $data['description'] ?? null,
        );
    }
}