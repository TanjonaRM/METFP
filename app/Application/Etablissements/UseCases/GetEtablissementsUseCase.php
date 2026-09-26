<?php

namespace Application\Etablissements\UseCases;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class GetEtablissementsUseCase
{
    public function execute(): Collection
    {
        return EtablissementModel::withCount('formateurs')->get();
    }

    public function findById(int $id): ?EtablissementModel
    {
        return EtablissementModel::with(['formateurs', 'sessions'])->find($id);
    }
}