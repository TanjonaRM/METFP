<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class EloquentAffectationRepository
{
    public function findById(int $id): ?AffectationModel
    {
        return AffectationModel::find($id);
    }

    public function findAll(): array
    {
        return AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->orderBy('date_debut', 'desc')
            ->get()
            ->all();
    }

    public function findByFormateur(int $formateurId): array
    {
        return AffectationModel::where('formateur_id', $formateurId)
            ->with(['filiere', 'etablissement'])
            ->orderBy('date_debut', 'desc')
            ->get()
            ->all();
    }

    public function save(array $data): AffectationModel
    {
        if (isset($data['id']) && $data['id']) {
            $model = AffectationModel::findOrFail($data['id']);
            $model->update($data);
            return $model;
        }
        return AffectationModel::create($data);
    }

    public function delete(int $id): void
    {
        AffectationModel::findOrFail($id)->delete();
    }
}