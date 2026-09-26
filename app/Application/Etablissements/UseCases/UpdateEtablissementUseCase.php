<?php

namespace Application\Etablissements\UseCases;

use Application\Etablissements\DTOs\UpdateEtablissementDTO;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class UpdateEtablissementUseCase
{
    public function execute(UpdateEtablissementDTO $dto): EtablissementModel
    {
        $model = EtablissementModel::findOrFail($dto->id);

        $model->update([
            'code' => $dto->code,
            'nom' => $dto->nom,
            'type' => $dto->type,
            'region' => $dto->region,
            'adresse' => $dto->adresse,
            'telephone' => $dto->telephone,
            'email' => $dto->email,
        ]);

        return $model;
    }
}