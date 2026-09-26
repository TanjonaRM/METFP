<?php

namespace Application\Affectations\UseCases;

use Application\Affectations\DTOs\UpdateAffectationDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class UpdateAffectationUseCase
{
    public function execute(UpdateAffectationDTO $dto): AffectationModel
    {
        $affectation = AffectationModel::findOrFail($dto->id);
        $affectation->update($dto->toArray());

        return $affectation;
    }
}