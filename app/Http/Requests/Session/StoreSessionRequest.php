<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'code'             => ['required', 'string', 'max:50', 'unique:sessions,code'],
            'libelle'          => ['required', 'string', 'max:150'],
            'filiere_id'       => ['required', 'exists:filieres,id'],
            'niveau_id'        => ['nullable', 'exists:niveaux,id'],
            'date_debut'       => ['required', 'date'],
            'date_fin'         => ['required', 'date', 'after:date_debut'],
            'nb_places'        => ['nullable', 'integer', 'min:1'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required'       => 'Le code de la session est obligatoire.',
            'code.unique'         => 'Ce code de session existe déjà.',
            'libelle.required'    => 'Le libellé est obligatoire.',
            'filiere_id.required' => 'La filière est obligatoire.',
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_fin.required'   => 'La date de fin est obligatoire.',
            'date_fin.after'      => 'La date de fin doit être après la date de début.',
        ];
    }
}