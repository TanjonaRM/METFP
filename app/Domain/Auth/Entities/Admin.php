<?php

namespace Domain\Auth\Entities;

class Admin
{
    public function __construct(
        public ?int $id,
        public string $nom,
        public string $prenom,
        public string $email,
        public ?string $password = null,
        public string $role = 'admin',
        public ?string $avatar = null,
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function estGestionnaire(): bool
    {
        return $this->role === 'gestionnaire';
    }
}