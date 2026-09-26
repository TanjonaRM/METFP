<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class NomComplet
{
    private string $nom;
    private string $prenom;

    public function __construct(string $nom, string $prenom)
    {
        $nom = trim($nom);
        $prenom = trim($prenom);

        if (empty($nom)) {
            throw new InvalidArgumentException("Le nom ne peut pas être vide.");
        }

        if (empty($prenom)) {
            throw new InvalidArgumentException("Le prénom ne peut pas être vide.");
        }

        if (strlen($nom) > 100) {
            throw new InvalidArgumentException("Le nom ne peut pas dépasser 100 caractères.");
        }

        if (strlen($prenom) > 100) {
            throw new InvalidArgumentException("Le prénom ne peut pas dépasser 100 caractères.");
        }

        $this->nom = ucfirst(strtolower($nom));
        $this->prenom = ucfirst(strtolower($prenom));
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Format : "Prénom Nom" (convention Madagascar)
     */
    public function getFormatted(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Format : "NOM Prénom"
     */
    public function getFormattedAvecNomMajuscule(): string
    {
        return strtoupper($this->nom) . ' ' . $this->prenom;
    }

    public function getInitiales(): string
    {
        return strtoupper(substr($this->prenom, 0, 1) . substr($this->nom, 0, 1));
    }

    public function equals(NomComplet $other): bool
    {
        return $this->nom === $other->nom && $this->prenom === $other->prenom;
    }

    public function __toString(): string
    {
        return $this->getFormatted();
    }
}