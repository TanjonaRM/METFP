<?php

namespace Application\Secteurs\UseCases;

use Application\Secteurs\DTOs\CreateSecteurDTO;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class CreateSecteurUseCase
{
    public function execute(CreateSecteurDTO $dto): SecteurModel
    {
        return SecteurModel::create([
            'code' => $dto->code,
            'libelle' => $dto->libelle,
        ]);
    }
}