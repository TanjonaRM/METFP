<?php

namespace Application\Formateurs\UseCases\DeleteFormateur;

use Domain\Formateurs\Exceptions\FormateurNotFoundException;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;

class DeleteFormateurUseCase
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
    ) {}

    public function execute(int $id): void
    {
        $existing = $this->repository->findById($id);
        if (!$existing) {
            throw FormateurNotFoundException::withId($id);
        }

        $this->repository->delete($id);
    }
}