<?php

namespace Application\Etablissements\UseCases;

use Application\Etablissements\DTOs\CreateEtablissementDTO;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class CreateEtablissementUseCase
{
    public function execute(CreateEtablissementDTO $dto): EtablissementModel
    {
        return EtablissementModel::create([
            'code' => $dto->code,
            'nom' => $dto->nom,
            'type' => $dto->type,
            'region' => $dto->region,
            'adresse' => $dto->adresse,
            'telephone' => $dto->telephone,
            'email' => $dto->email,
        ]);
    }
}