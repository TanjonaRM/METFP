<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffectationSeeder extends Seeder
{
    public function run(): void
    {
        $formateurs = DB::table('formateurs')->pluck('id');
        $filieres = DB::table('filieres')->pluck('id');
        $etablissements = DB::table('etablissements')->pluck('id');

        if ($formateurs->isEmpty() || $filieres->isEmpty() || $etablissements->isEmpty()) {
            return;
        }

        foreach ($formateurs as $formateurId) {
            DB::table('affectations')->insert([
                'formateur_id' => $formateurId,
                'filiere_id' => $filieres->random(),
                'etablissement_id' => $etablissements->random(),
                'date_debut' => now()->subMonth(),
                'date_fin' => now()->addMonths(6),
                'statut' => 'actif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}