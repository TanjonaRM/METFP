<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // Sauvegarder les données
            $formateurs = DB::table('formateurs')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('formateurs');

            Schema::create('formateurs', function (Blueprint $table) {
                $table->id();
                $table->string('matricule', 50)->unique();
                $table->string('nom', 100);
                $table->string('prenom', 100);
                $table->enum('sexe', ['Masculin', 'Feminin'])->nullable();
                $table->date('date_naissance')->nullable();
                $table->string('lieu_naissance')->nullable();
                $table->string('cin', 50)->nullable();
                $table->string('email')->unique();
                $table->string('telephone', 20)->nullable();
                $table->text('adresse')->nullable();
                $table->string('grade', 50)->nullable();
                $table->date('date_recrutement')->nullable();
                $table->string('photo')->nullable();
                $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
                $table->string('statut')->default('actif'); // actif / inactif / suspendu
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::enableForeignKeyConstraints();

            // Restaurer les données
            foreach ($formateurs as $f) {
                DB::table('formateurs')->insert([
                    'id'               => $f->id,
                    'matricule'        => $f->matricule,
                    'nom'              => $f->nom,
                    'prenom'           => $f->prenom,
                    'sexe'             => $f->sexe,
                    'date_naissance'   => $f->date_naissance,
                    'lieu_naissance'   => $f->lieu_naissance,
                    'cin'              => $f->cin,
                    'email'            => $f->email,
                    'telephone'        => $f->telephone,
                    'adresse'          => $f->adresse,
                    'grade'            => $f->grade,
                    'date_recrutement' => $f->date_recrutement,
                    'photo'            => $f->photo,
                    'etablissement_id' => $f->etablissement_id,
                    'statut'           => $f->statut,
                    'created_at'       => $f->created_at,
                    'updated_at'       => $f->updated_at,
                    'deleted_at'       => $f->deleted_at,
                ]);
            }
        }
    }

    public function down(): void
    {
        // Pas de rollback
    }
};