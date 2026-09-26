<?php

namespace Domain\Auth\Entities;

class User
{
    public function __construct(
        public ?int $id,
        public string $nom,
        public string $prenom,
        public string $email,
        public ?string $password = null,
        public string $role = 'user',
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }
}