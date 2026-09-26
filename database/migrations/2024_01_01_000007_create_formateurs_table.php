<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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
            $table->string('fonction')->nullable();
            $table->string('grade', 50)->nullable();
            $table->date('date_recrutement')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
            $table->enum('statut', ['actif', 'inactif', 'en_attente'])->default('actif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formateurs');
    }
};