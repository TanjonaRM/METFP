<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check() && auth('admin')->user()->role === 'super_admin';
    }

    public function rules(): array
    {
        return [
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,gestionnaire',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'       => 'Cet email est déjà utilisé.',
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'role.in'            => 'Le rôle doit être : super_admin, admin ou gestionnaire.',
        ];
    }
}