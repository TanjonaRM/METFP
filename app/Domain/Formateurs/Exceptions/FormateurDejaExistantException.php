<?php

namespace Domain\Formateurs\Exceptions;

use Exception;

class FormateurDejaExistantException extends Exception
{
    public static function withMatricule(string $matricule): self
    {
        return new self("Un formateur avec le matricule {$matricule} existe déjà.");
    }
}