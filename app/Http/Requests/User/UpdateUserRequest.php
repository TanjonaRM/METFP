<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('user');

        return [
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => ['required', 'email', 'max:150', Rule::unique('admins', 'email')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,gestionnaire',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Cet email est déjà utilisé.',
        ];
    }
}