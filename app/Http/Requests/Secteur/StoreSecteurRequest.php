<?php

namespace App\Http\Requests\Secteur;

use Illuminate\Foundation\Http\FormRequest;

class StoreSecteurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'code'    => ['required', 'string', 'max:50', 'unique:secteurs,code'],
            'libelle' => ['required', 'string', 'max:150'],
        ];
    }
}