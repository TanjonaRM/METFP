<?php

namespace Application\Niveaux\UseCases;

use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class DeleteNiveauUseCase
{
    public function execute(int $id): void
    {
        NiveauModel::findOrFail($id)->delete();
    }
}