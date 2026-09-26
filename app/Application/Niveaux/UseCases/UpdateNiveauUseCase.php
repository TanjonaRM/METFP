<?php

namespace Application\Niveaux\UseCases;

use Application\Niveaux\DTOs\UpdateNiveauDTO;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class UpdateNiveauUseCase
{
    public function execute(UpdateNiveauDTO $dto): NiveauModel
    {
        $model = NiveauModel::findOrFail($dto->id);
        $model->update([
            'code' => $dto->code,
            'libelle' => $dto->libelle,
            'description' => $dto->description,
        ]);
        return $model;
    }
}