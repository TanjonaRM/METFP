<?php

namespace App\Http\Requests\Niveau;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNiveauRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('niveau') ?? $this->route('id');

        return [
            'code'    => ['required', 'string', 'max:50', Rule::unique('niveaux', 'code')->ignore($id)],
            'libelle' => ['required', 'string', 'max:150'],
        ];
    }
}