<?php

namespace App\Http\Requests\Formateur;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'matricule'        => ['nullable', 'string', 'max:50', 'unique:formateurs,matricule'],
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255', 'unique:formateurs,email'],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'sexe'             => ['nullable', 'in:Masculin,Feminin'],
            'date_naissance'   => ['nullable', 'date'],
            'cin'              => ['nullable', 'string', 'max:50'],
            'adresse'          => ['nullable', 'string', 'max:255'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
            'filiere_id'       => ['nullable', 'exists:filieres,id'],
            'date_debut'       => ['nullable', 'date'],
            'date_fin'         => ['nullable', 'date', 'after_or_equal:date_debut'],
            'statut_session'   => ['nullable', 'in:active,terminee,annulee'],
            'statut'           => ['nullable', 'in:actif,inactif,en_attente'],
        ];
    }

    public function messages(): array
    {
        return [
            'matricule.regex'  => 'Le matricule doit suivre le format FORM-XXX.',
            'matricule.unique' => 'Ce matricule est déjà utilisé.',
            'email.unique'     => 'Cet email est déjà utilisé.',
        ];
    }
}