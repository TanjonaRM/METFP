<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            NiveauSeeder::class,
            SecteurSeeder::class,
            FiliereSeeder::class,
            EtablissementSeeder::class,
            AdminSeeder::class,
            FormateurSeeder::class,
        ]);
    }
}