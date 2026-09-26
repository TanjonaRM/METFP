<?php

namespace Application\Filieres\UseCases;

use Application\Filieres\DTOs\CreateFiliereDTO;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;

class CreateFiliereUseCase
{
    public function execute(CreateFiliereDTO $dto): FiliereModel
    {
        $filiere = FiliereModel::create([
            'code' => $dto->code,
            'libelle' => $dto->libelle,
            'niveau_id' => $dto->niveauId,
            'secteur_id' => $dto->secteurId,
            'description' => $dto->description,
        ]);

        foreach ($dto->options as $opt) {
            $filiere->options()->create(['libelle' => $opt]);
        }

        return $filiere;
    }
}