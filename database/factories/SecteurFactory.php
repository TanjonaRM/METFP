<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class SecteurFactory extends Factory
{
    protected $model = SecteurModel::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'libelle' => strtoupper($this->faker->word()),
        ];
    }
}