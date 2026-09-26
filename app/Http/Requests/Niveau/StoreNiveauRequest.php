<?php

namespace App\Http\Requests\Niveau;

use Illuminate\Foundation\Http\FormRequest;

class StoreNiveauRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'code'    => ['required', 'string', 'max:50', 'unique:niveaux,code'],
            'libelle' => ['required', 'string', 'max:150'],
        ];
    }
}