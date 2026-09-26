<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demande_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('filiere_id')->nullable()->constrained('filieres')->nullOnDelete();
            $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
            $table->string('titre')->nullable();
            $table->date('date_debut_souhaitee')->nullable();
            $table->date('date_fin_souhaitee')->nullable();
            $table->integer('nb_places_souhaitees')->default(0);
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
        Schema::dropIfExists('demande_sessions');
    }
};