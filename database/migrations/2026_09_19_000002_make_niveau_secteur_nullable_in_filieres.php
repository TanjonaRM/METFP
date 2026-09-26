<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // Sauvegarder les données
            $filieres = DB::table('filieres')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('filieres');

            Schema::create('filieres', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('libelle');
                $table->unsignedBigInteger('niveau_id')->nullable();
                $table->unsignedBigInteger('secteur_id')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
            Schema::enableForeignKeyConstraints();

            // Restaurer les données
            foreach ($filieres as $f) {
                DB::table('filieres')->insert([
                    'id'          => $f->id,
                    'code'        => $f->code,
                    'libelle'     => $f->libelle,
                    'niveau_id'   => null,
                    'secteur_id'  => null,
                    'description' => $f->description,
                    'created_at'  => $f->created_at,
                    'updated_at'  => $f->updated_at,
                ]);
            }
        } else {
            Schema::table('filieres', function (Blueprint $table) {
                $table->unsignedBigInteger('niveau_id')->nullable()->change();
                $table->unsignedBigInteger('secteur_id')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Pas de rollback
    }
};