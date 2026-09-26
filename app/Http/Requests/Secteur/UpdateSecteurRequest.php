<?php

namespace App\Http\Requests\Secteur;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSecteurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('secteur') ?? $this->route('id');

        return [
            'code'    => ['required', 'string', 'max:50', Rule::unique('secteurs', 'code')->ignore($id)],
            'libelle' => ['required', 'string', 'max:150'],
        ];
    }
}