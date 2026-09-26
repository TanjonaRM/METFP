<?php

namespace Application\Niveaux\UseCases;

use Application\Niveaux\DTOs\CreateNiveauDTO;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class CreateNiveauUseCase
{
    public function execute(CreateNiveauDTO $dto): NiveauModel
    {
        return NiveauModel::create([
            'code' => $dto->code,
            'libelle' => $dto->libelle,
            'description' => $dto->description,
        ]);
    }
}