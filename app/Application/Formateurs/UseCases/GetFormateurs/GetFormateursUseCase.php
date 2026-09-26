<?php

namespace Application\Formateurs\UseCases\GetFormateurs;

use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Illuminate\Support\Collection;

class GetFormateursUseCase
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
    ) {}

    public function execute(): Collection
    {
        return collect($this->repository->findAll());
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
}