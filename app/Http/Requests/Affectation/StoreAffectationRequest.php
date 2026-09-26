<?php

namespace App\Http\Requests\Affectation;

use Illuminate\Foundation\Http\FormRequest;

class StoreAffectationRequest extends FormRequest
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

    public function messages(): array
    {
        return [
            'formateur_id.required'     => 'Le formateur est obligatoire.',
            'filiere_id.required'       => 'La filière est obligatoire.',
            'etablissement_id.required' => 'L\'établissement est obligatoire.',
            'date_debut.required'       => 'La date de début est obligatoire.',
            'date_fin.after_or_equal'   => 'La date de fin doit être après la date de début.',
            'statut.in'                 => 'Le statut doit être : actif, termine ou suspendu.',
        ];
    }
}