<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\FormateurUserModel;

class FormateurUserFactory extends Factory
{
    protected $model = FormateurUserModel::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'matricule' => 'FORM-' . $this->faker->unique()->numberBetween(100, 999),
            'telephone' => $this->faker->phoneNumber(),
            'statut' => 'actif',
            'email_verified_at' => now(),
        ];
    }
}