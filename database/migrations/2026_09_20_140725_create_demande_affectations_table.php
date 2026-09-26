<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demande_affectations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('filiere_id')->nullable()->constrained('filieres')->nullOnDelete();
            $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
            $table->date('date_souhaitee')->nullable();
            $table->text('motif')->nullable();
            $table->enum('statut', ['en_attente', 'approuvee', 'refusee'])->default('en_attente');
            $table->text('reponse_admin')->nullable();
            $table->timestamp('traitee_le')->nullable();
            $table->timestamps();

            $table->index('statut');
            $table->index('formateur_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demande_affectations');
    }
};