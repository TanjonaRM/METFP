<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveauSeeder extends Seeder
{
    public function run(): void
    {
        $niveaux = [
            ['code' => 'BAC',  'libelle' => 'Baccalauréat Technologique et Professionnel', 'description' => 'BAC TECHNO / BAC PRO'],
            ['code' => 'BEP',  'libelle' => 'Brevet d\'Études Professionnelles',            'description' => 'BEP'],
            ['code' => 'CAP',  'libelle' => 'Certificat d\'Aptitude Professionnelle',       'description' => 'CAP'],
            ['code' => 'CFA',  'libelle' => 'Certificat de Fin d\'Apprentissage',           'description' => 'CFA'],
            ['code' => 'CAPS', 'libelle' => 'Certificat d\'Aptitude Professionnelle Spécialisée', 'description' => 'CAPS'],
        ];

        foreach ($niveaux as $n) {
            DB::table('niveaux')->insert(array_merge($n, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}