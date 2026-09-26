<?php

namespace Application\Affectations\UseCases;

use Application\Affectations\DTOs\CreateAffectationDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class CreateAffectationUseCase
{
    public function execute(CreateAffectationDTO $dto): AffectationModel
    {
        $affectation = AffectationModel::create($dto->toArray());

        $code = SessionModel::generateNextCode();

        SessionModel::create([
            'code'             => $code,
            'titre'            => 'Session ' . ($affectation->filiere->libelle ?? ''),
            'filiere_id'       => $dto->filiere_id,
            'formateur_id'     => $dto->formateur_id,
            'etablissement_id' => $dto->etablissement_id,
            'date_debut'       => $dto->date_debut,
            'date_fin'         => $dto->date_fin ?? now()->addMonths(6)->toDateString(),
            'nb_places'        => 0,
            'description'      => null,
            'statut'           => 'actif',
        ]);

        return $affectation;
    }
}