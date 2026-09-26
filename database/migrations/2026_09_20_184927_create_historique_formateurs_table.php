<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historique_formateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();

            // Type d'événement
            $table->enum('type', [
                'affectation',      // affectation ajoutée
                'session',          // session créée
                'etablissement',    // changement établissement
                'filiere',          // changement filière
                'statut',           // changement de statut
            ]);

            // Référence à l'entité liée
            $table->string('entite_type')->nullable();  // 'Etablissement', 'Filiere', 'Affectation', 'Session'
            $table->unsignedBigInteger('entite_id')->nullable();

            // Valeurs (avant/après)
            $table->string('valeur_avant')->nullable();
            $table->string('valeur_apres')->nullable();

            // Détails complets (JSON pour flexibilité)
            $table->json('details')->nullable();

            // Qui a fait l'action
            $table->string('source')->default('admin');  // 'admin', 'system', 'formateur'

            // Quand
            $table->timestamp('survenu_le');

            $table->timestamps();

            $table->index(['formateur_id', 'type']);
            $table->index('survenu_le');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historique_formateurs');
    }
};