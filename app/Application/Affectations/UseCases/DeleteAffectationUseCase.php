<?php

namespace Application\Affectations\UseCases;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class DeleteAffectationUseCase
{
    public function execute(int $id): void
    {
        $affectation = AffectationModel::findOrFail($id);
        $affectation->delete();
    }
}