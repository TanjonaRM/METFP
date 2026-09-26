<?php

namespace App\Http\Requests\Filiere;

use Illuminate\Foundation\Http\FormRequest;

class StoreFiliereRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'code'       => ['required', 'string', 'max:50', 'unique:filieres,code'],
            'libelle'    => ['required', 'string', 'max:150'],
            'secteur_id' => ['nullable', 'exists:secteurs,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required'    => 'Le code de la filière est obligatoire.',
            'code.unique'      => 'Ce code est déjà utilisé.',
            'libelle.required' => 'Le libellé est obligatoire.',
        ];
    }
}