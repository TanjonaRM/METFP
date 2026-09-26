<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formations_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('titre')->nullable();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nb_places')->default(0);
            $table->text('description')->nullable();
            $table->enum('statut', ['active', 'terminee', 'annulee'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations_sessions');
    }
};