<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class SessionFactory extends Factory
{
    protected $model = SessionModel::class;

    public function definition(): array
    {
        return [
            'code' => 'SESS-' . $this->faker->unique()->numberBetween(1000, 9999),
            'titre' => 'Session ' . $this->faker->words(3, true),
            'filiere_id' => FiliereModel::factory(),
            'formateur_id' => FormateurModel::factory(),
            'etablissement_id' => EtablissementModel::factory(),
            'date_debut' => now()->addDays(10),
            'date_fin' => now()->addMonths(3),
            'nb_places' => $this->faker->numberBetween(10, 30),
            'description' => $this->faker->optional()->paragraph(),
            'statut' => 'active',
        ];
    }
}