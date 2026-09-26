<?php

namespace Application\Secteurs\UseCases;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class GetSecteursUseCase
{
    public function execute(): Collection
    {
        return SecteurModel::withCount('filieres')->get();
    }
}