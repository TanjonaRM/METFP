<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('session') ?? $this->route('id');

        return [
            'code'             => ['required', 'string', 'max:50', Rule::unique('sessions', 'code')->ignore($id)],
            'libelle'          => ['required', 'string', 'max:150'],
            'filiere_id'       => ['required', 'exists:filieres,id'],
            'niveau_id'        => ['nullable', 'exists:niveaux,id'],
            'date_debut'       => ['required', 'date'],
            'date_fin'         => ['required', 'date', 'after:date_debut'],
            'nb_places'        => ['nullable', 'integer', 'min:1'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
        ];
    }
}