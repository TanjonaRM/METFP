<?php

namespace Application\Formateurs\DTOs;

class UpdateFormateurDTO
{
    public function __construct(
        public int $id,
        public string $nom,
        public string $prenom,
        public string $email,
        public ?string $telephone = null,
        public ?int $etablissementId = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id: $id,
            nom: $data['nom'],
            prenom: $data['prenom'],
            email: $data['email'],
            telephone: $data['telephone'] ?? null,
            etablissementId: $data['etablissement_id'] ?? null,
            statut: $data['statut'] ?? 'actif',
        );
    }
}