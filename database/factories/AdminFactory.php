<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;

class AdminFactory extends Factory
{
    protected $model = AdminModel::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ];
    }
}