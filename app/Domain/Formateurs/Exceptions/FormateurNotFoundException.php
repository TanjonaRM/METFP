<?php

namespace Domain\Formateurs\Exceptions;

use Exception;

class FormateurNotFoundException extends Exception
{
    public static function withId(int $id): self
    {
        return new self("Formateur avec ID {$id} introuvable.");
    }

    public static function withMatricule(string $matricule): self
    {
        return new self("Formateur avec matricule '{$matricule}' introuvable.");
    }
}