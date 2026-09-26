<?php

namespace Application\Niveaux\DTOs;

class CreateNiveauDTO
{
    public function __construct(
        public string $code,
        public string $libelle,
        public ?string $description = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'],
            libelle: $data['libelle'],
            description: $data['description'] ?? null,
        );
    }
}