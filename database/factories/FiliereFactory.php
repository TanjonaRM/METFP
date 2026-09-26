<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class FiliereFactory extends Factory
{
    protected $model = FiliereModel::class;

    public function definition(): array
    {
        return [
            'code' => 'FIL-' . $this->faker->unique()->numberBetween(100, 999),
            'libelle' => $this->faker->sentence(3),
            'niveau_id' => NiveauModel::factory(),
            'secteur_id' => SecteurModel::factory(),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}
