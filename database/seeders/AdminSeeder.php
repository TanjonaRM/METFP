<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@sgformateurs.mg',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('admins')->insert([
            'nom' => 'Rakoto',
            'prenom' => 'Jean',
            'email' => 'gestionnaire@sgformateurs.mg',
            'password' => Hash::make('password'),
            'role' => 'gestionnaire',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}