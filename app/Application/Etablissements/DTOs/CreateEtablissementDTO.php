<?php

namespace Application\Etablissements\DTOs;

class CreateEtablissementDTO
{
    public function __construct(
        public string $code,
        public string $nom,
        public string $type = 'CFP',
        public ?string $region = null,
        public ?string $adresse = null,
        public ?string $telephone = null,
        public ?string $email = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'],
            nom: $data['nom'],
            type: $data['type'] ?? 'CFP',
            region: $data['region'] ?? null,
            adresse: $data['adresse'] ?? null,
            telephone: $data['telephone'] ?? null,
            email: $data['email'] ?? null,
        );
    }
}