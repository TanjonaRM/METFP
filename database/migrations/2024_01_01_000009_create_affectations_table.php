<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['actif', 'termine', 'suspendu'])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};