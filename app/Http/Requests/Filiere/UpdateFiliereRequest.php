<?php

namespace App\Http\Requests\Filiere;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFiliereRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('filiere') ?? $this->route('id');

        return [
            'code'       => ['required', 'string', 'max:50', Rule::unique('filieres', 'code')->ignore($id)],
            'libelle'    => ['required', 'string', 'max:150'],
            'secteur_id' => ['nullable', 'exists:secteurs,id'],
        ];
    }
}