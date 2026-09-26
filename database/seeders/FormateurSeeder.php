<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormateurSeeder extends Seeder
{
    public function run(): void
    {
        $etablissements = DB::table('etablissements')->pluck('id', 'code');

        $formateurs = [
            ['matricule' => 'FORM-001', 'nom' => 'Rakoto',  'prenom' => 'Jean',   'email' => 'jean.rakoto@metfp.mg',  'etablissement' => 'CFP-AMBILOBE'],
            ['matricule' => 'FORM-002', 'nom' => 'Rasoa',   'prenom' => 'Marie',  'email' => 'marie.rasoa@metfp.mg',  'etablissement' => 'CFP-AMBILOBE'],
            ['matricule' => 'FORM-003', 'nom' => 'Andria',  'prenom' => 'Paul',   'email' => 'paul.andria@metfp.mg',  'etablissement' => 'LTP-MAHAMASINA'],
            ['matricule' => 'FORM-004', 'nom' => 'Randria', 'prenom' => 'Sophie', 'email' => 'sophie.randria@metfp.mg','etablissement' => 'LTP-TOAMASINA'],
        ];

        foreach ($formateurs as $f) {
            $etabId = $etablissements[$f['etablissement']] ?? null;

            // 1. Compte de connexion
            DB::table('formateurs_users')->insert([
                'matricule' => $f['matricule'],
                'nom' => $f['nom'],
                'prenom' => $f['prenom'],
                'email' => $f['email'],
                'password' => Hash::make('password'),
                'etablissement_id' => $etabId,
                'statut' => 'actif',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Données métier
            DB::table('formateurs')->insert([
                'matricule' => $f['matricule'],
                'nom' => $f['nom'],
                'prenom' => $f['prenom'],
                'sexe' => 'Masculin',
                'email' => $f['email'],
                'telephone' => '034000000' . rand(1, 9),
                'etablissement_id' => $etabId,
                'fonction' => 'Formateur',
                'grade' => 'P2',
                'statut' => 'actif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}