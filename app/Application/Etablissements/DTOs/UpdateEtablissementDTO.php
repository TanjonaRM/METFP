<?php

namespace Application\Etablissements\DTOs;

class UpdateEtablissementDTO
{
    public function __construct(
        public int $id,
        public string $code,
        public string $nom,
        public string $type,
        public ?string $region = null,
        public ?string $adresse = null,
        public ?string $telephone = null,
        public ?string $email = null,
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id: $id,
            code: $data['code'],
            nom: $data['nom'],
            type: $data['type'],
            region: $data['region'] ?? null,
            adresse: $data['adresse'] ?? null,
            telephone: $data['telephone'] ?? null,
            email: $data['email'] ?? null,
        );
    }
}