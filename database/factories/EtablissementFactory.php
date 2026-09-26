<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class EtablissementFactory extends Factory
{
    protected $model = EtablissementModel::class;

    public function definition(): array
    {
        return [
            'code' => 'ETB-' . $this->faker->unique()->numberBetween(100, 999),
            'nom' => 'Établissement ' . $this->faker->city(),
            'type' => $this->faker->randomElement(['CFP', 'LTP', 'Lycee', 'Autre']),
            'region' => $this->faker->city(),
            'adresse' => $this->faker->address(),
            'telephone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}