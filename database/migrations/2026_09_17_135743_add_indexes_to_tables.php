<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Index formateurs
        Schema::table('formateurs', function (Blueprint $table) {
            $table->index('nom', 'idx_formateurs_nom');
            $table->index('prenom', 'idx_formateurs_prenom');
            $table->index('statut', 'idx_formateurs_statut');
            $table->index('etablissement_id', 'idx_formateurs_etab');
        });

        // Index affectations
        Schema::table('affectations', function (Blueprint $table) {
            $table->index('statut', 'idx_affectations_statut');
            $table->index('date_debut', 'idx_affectations_debut');
            $table->index('formateur_id', 'idx_affectations_formateur');
            $table->index('etablissement_id', 'idx_affectations_etab');
            $table->index('filiere_id', 'idx_affectations_filiere');
        });

        // Index formations_sessions
        Schema::table('formations_sessions', function (Blueprint $table) {
            $table->index('statut', 'idx_sessions_statut');
            $table->index('date_debut', 'idx_sessions_debut');
            $table->index('date_fin', 'idx_sessions_fin');
            $table->index('formateur_id', 'idx_sessions_formateur');
        });

        // Index etablissements
        Schema::table('etablissements', function (Blueprint $table) {
            $table->index('nom', 'idx_etablissements_nom');
            $table->index('type', 'idx_etablissements_type');
        });

        // Index filieres
        Schema::table('filieres', function (Blueprint $table) {
            $table->index('libelle', 'idx_filieres_libelle');
            $table->index('niveau_id', 'idx_filieres_niveau');
            $table->index('secteur_id', 'idx_filieres_secteur');
        });
    }

    public function down(): void
    {
        Schema::table('formateurs', function (Blueprint $table) {
            $table->dropIndex('idx_formateurs_nom');
            $table->dropIndex('idx_formateurs_prenom');
            $table->dropIndex('idx_formateurs_statut');
            $table->dropIndex('idx_formateurs_etab');
        });

        Schema::table('affectations', function (Blueprint $table) {
            $table->dropIndex('idx_affectations_statut');
            $table->dropIndex('idx_affectations_debut');
            $table->dropIndex('idx_affectations_formateur');
            $table->dropIndex('idx_affectations_etab');
            $table->dropIndex('idx_affectations_filiere');
        });

        Schema::table('formations_sessions', function (Blueprint $table) {
            $table->dropIndex('idx_sessions_statut');
            $table->dropIndex('idx_sessions_debut');
            $table->dropIndex('idx_sessions_fin');
            $table->dropIndex('idx_sessions_formateur');
        });

        Schema::table('etablissements', function (Blueprint $table) {
            $table->dropIndex('idx_etablissements_nom');
            $table->dropIndex('idx_etablissements_type');
        });

        Schema::table('filieres', function (Blueprint $table) {
            $table->dropIndex('idx_filieres_libelle');
            $table->dropIndex('idx_filieres_niveau');
            $table->dropIndex('idx_filieres_secteur');
        });
    }
};