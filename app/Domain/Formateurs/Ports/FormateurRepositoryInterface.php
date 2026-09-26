<?php

namespace Domain\Formateurs\Ports;

use Domain\Formateurs\Entities\Formateur;

interface FormateurRepositoryInterface
{
    public function save(Formateur $formateur): Formateur;
    public function findById(int $id): ?Formateur;
    public function findByMatricule(string $matricule): ?Formateur;
    public function findAll(): array;
    public function delete(int $id): void;
}