<?php

namespace App\Http\Requests\Formateur;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('formateur');

        return [
            'matricule'        => ['required', 'string', 'max:50', Rule::unique('formateurs', 'matricule')->ignore($id), 'regex:/^FORM-\d{3,}$/'],
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255', Rule::unique('formateurs', 'email')->ignore($id)],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'sexe'             => ['nullable', 'in:Masculin,Feminin'],
            'date_naissance'   => ['nullable', 'date'],
            'lieu_naissance'   => ['nullable', 'string', 'max:150'],
            'cin'              => ['nullable', 'string', 'max:50'],
            'adresse'          => ['nullable', 'string', 'max:255'],
            'grade'            => ['required', 'string', 'max:50'],
            'date_recrutement' => ['nullable', 'date'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
            'filiere_id'       => ['nullable', 'exists:filieres,id'],
            'statut'           => ['required', 'in:actif,inactif,suspendu'],
        ];
    }

    public function messages(): array
    {
        return [
            'matricule.regex'  => 'Le matricule doit suivre le format FORM-XXX.',
            'matricule.unique' => 'Ce matricule est déjà utilisé.',
            'email.unique'     => 'Cet email est déjà utilisé.',
            'statut.in'        => 'Le statut doit être : actif, inactif ou suspendu.',
        ];
    }
}