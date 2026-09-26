<?php

namespace Domain\Auth\Entities;

class FormateurUser
{
    public function __construct(
        public ?int $id,
        public string $nom,
        public string $prenom,
        public string $email,
        public string $matricule,
        public ?string $password = null,
        public ?string $telephone = null,
        public ?int $etablissementId = null,
        public string $statut = 'en_attente',
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estActif(): bool
    {
        return $this->statut === 'actif';
    }

    public function estEnAttente(): bool
    {
        return $this->statut === 'en_attente';
    }
}