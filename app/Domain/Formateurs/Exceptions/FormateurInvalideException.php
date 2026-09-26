<?php

namespace Domain\Formateurs\Exceptions;

use Exception;

class FormateurInvalideException extends Exception
{
    public static function emailInvalide(string $email): self
    {
        return new self("L'email '{$email}' n'est pas valide.");
    }

    public static function matriculeInvalide(string $matricule): self
    {
        return new self(
            "Le matricule '{$matricule}' n'est pas valide. Format attendu : FORM-XXX."
        );
    }

    public static function nomVide(): self
    {
        return new self("Le nom ne peut pas être vide.");
    }

    public static function prenomVide(): self
    {
        return new self("Le prénom ne peut pas être vide.");
    }

    public static function telephoneInvalide(string $telephone): self
    {
        return new self("Le numéro de téléphone '{$telephone}' n'est pas valide.");
    }
}