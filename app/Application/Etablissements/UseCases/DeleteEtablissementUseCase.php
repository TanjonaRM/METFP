<?php

namespace Application\Etablissements\UseCases;

use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class DeleteEtablissementUseCase
{
    public function execute(int $id): void
    {
        EtablissementModel::findOrFail($id)->delete();
    }
}