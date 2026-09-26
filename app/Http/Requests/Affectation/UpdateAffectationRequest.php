<?php

namespace App\Http\Requests\Affectation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ];
    }
}