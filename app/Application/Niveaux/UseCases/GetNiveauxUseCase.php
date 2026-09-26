<?php

namespace Application\Niveaux\UseCases;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class GetNiveauxUseCase
{
    public function execute(): Collection
    {
        return NiveauModel::withCount('filieres')->get();
    }
}