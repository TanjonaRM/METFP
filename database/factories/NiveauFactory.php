<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class NiveauFactory extends Factory
{
    protected $model = NiveauModel::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'libelle' => $this->faker->sentence(2),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}