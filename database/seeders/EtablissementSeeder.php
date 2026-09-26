<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtablissementSeeder extends Seeder
{
    public function run(): void
    {
        $etablissements = [
            ['code' => 'CFP-AMBILOBE', 'nom' => 'CFP AMBILOBE', 'type' => 'CFP'],
            ['code' => 'CFP-AMBATOFINANDRAHANA', 'nom' => 'CFP AMBATOFINANDRAHANA', 'type' => 'CFP'],
            ['code' => 'CFP-MAHAFASA', 'nom' => 'CFP MAHAFASA', 'type' => 'CFP'],
            ['code' => 'CFP-MAHAJANGA', 'nom' => 'CFP MAHAJANGA', 'type' => 'CFP'],
            ['code' => 'CFP-ANTANAMBAO', 'nom' => 'CFP ANTANAMBAO MANAMPOTSY', 'type' => 'CFP'],
            ['code' => 'CFP-FOULPOINTE', 'nom' => 'CFP FOULPOINTE', 'type' => 'CFP'],
            ['code' => 'CFP-MAROLAMBO', 'nom' => 'CFP MAROLAMBO', 'type' => 'CFP'],
            ['code' => 'CFP-BEFANDRIANA-SUD', 'nom' => 'CFP BEFANDRIANA-SUD', 'type' => 'CFP'],
            ['code' => 'CFP-EJEDA', 'nom' => 'CFP EJEDA', 'type' => 'CFP'],
            ['code' => 'CFP-MILENAKA', 'nom' => 'CFP MILENAKA', 'type' => 'CFP'],
            ['code' => 'LTP-MAHAMASINA', 'nom' => 'LTP MAHAMASINA', 'type' => 'LTP'],
            ['code' => 'LTP-MANTASOA', 'nom' => 'LTP MANTASOA', 'type' => 'LTP'],
            ['code' => 'LTP-ANTSIRANANA', 'nom' => 'LTP ANTSIRANANA', 'type' => 'LTP'],
            ['code' => 'LTP-TOAMASINA', 'nom' => 'LTP TOAMASINA', 'type' => 'LTP'],
        ];

        foreach ($etablissements as $e) {
            DB::table('etablissements')->insert(array_merge($e, [
                'region' => 'Analamanga',
                'adresse' => 'Rue principale',
                'telephone' => '02000000' . rand(10, 99),
                'email' => strtolower($e['code']) . '@metfp.mg',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}