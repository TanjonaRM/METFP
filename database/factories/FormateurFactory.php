<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class FormateurFactory extends Factory
{
    protected $model = FormateurModel::class;

    public function definition(): array
    {
        return [
            'matricule' => 'FORM-' . $this->faker->unique()->numberBetween(100, 999),
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'sexe' => $this->faker->randomElement(['Masculin', 'Feminin']),
            'date_naissance' => $this->faker->date('Y-m-d', '-25 years'),
            'lieu_naissance' => $this->faker->city(),
            'cin' => strtoupper($this->faker->bothify('??######')),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'fonction' => $this->faker->randomElement(['Formateur', 'Formateur principal', 'Chef de département']),
            'grade' => $this->faker->randomElement(['P1', 'P2', 'P3', 'P4']),
            'date_recrutement' => $this->faker->date('Y-m-d', '-5 years'),
            'statut' => 'actif',
        ];
    }
}