<?php

namespace Application\Secteurs\DTOs;

class CreateSecteurDTO
{
    public function __construct(
        public string $code,
        public string $libelle,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'],
            libelle: $data['libelle'],
        );
    }
}