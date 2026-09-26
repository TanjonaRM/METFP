<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecteurSeeder extends Seeder
{
    public function run(): void
    {
        $secteurs = [
            ['code' => 'IND', 'libelle' => 'INDUSTRIEL'],
            ['code' => 'GC',  'libelle' => 'GENIE CIVIL'],
            ['code' => 'TER', 'libelle' => 'TERTIAIRE'],
            ['code' => 'AGR', 'libelle' => 'AGRICOLE'],
            ['code' => 'THR', 'libelle' => 'TOURISME HÔTELLERIE RESTAURATION'],
            ['code' => 'THA', 'libelle' => 'THA'],
            ['code' => 'TIC', 'libelle' => 'TIC'],
        ];

        foreach ($secteurs as $s) {
            DB::table('secteurs')->insert(array_merge($s, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}