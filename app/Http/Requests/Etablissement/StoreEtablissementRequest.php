<?php

namespace App\Http\Requests\Etablissement;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtablissementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'code' => ['nullable', 'string', 'max:50'],

            'nom' => [
                'required',
                'string',
                'max:255',
            ],

            'type' => [
                'nullable',
                'string',
                'max:100',
            ],

            'region' => [
                'nullable',
                'string',
                'max:150',
            ],

            'adresse' => [
                'nullable',
                'string',
            ],

            'responsable_nom' => [
                'nullable',
                'string',
                'max:255',
            ],

            'responsable_telephone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'responsable_email' => [
                'nullable',
                'email',
                'max:255',
            ],
        ];
    }
}