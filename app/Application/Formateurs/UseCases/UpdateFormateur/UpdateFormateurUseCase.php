<?php

namespace Application\Formateurs\UseCases\UpdateFormateur;

use Application\Formateurs\DTOs\UpdateFormateurDTO;
use Domain\Formateurs\Entities\Formateur;
use Domain\Formateurs\Exceptions\FormateurNotFoundException;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;

class UpdateFormateurUseCase
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
    ) {}

    public function execute(UpdateFormateurDTO $dto): Formateur
    {
        $existing = $this->repository->findById($dto->id);
        if (!$existing) {
            throw FormateurNotFoundException::withId($dto->id);
        }

        $updated = new Formateur(
            id: $dto->id,
            matricule: $existing->matricule,
            nom: $dto->nom,
            prenom: $dto->prenom,
            email: $dto->email,
            telephone: $dto->telephone,
            etablissementId: $dto->etablissementId,
            statut: $dto->statut,
        );

        return $this->repository->save($updated);
    }
}