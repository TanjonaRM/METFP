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
            // ========== 1. RECRÉER formations_sessions SANS CHECK ==========
            $sessions = DB::table('formations_sessions')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('formations_sessions');

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
                $table->string('statut', 20)->default('actif'); // actif / inactif / suspendu
                $table->datetime('expire_le')->nullable();
                $table->timestamps();
            });
            Schema::enableForeignKeyConstraints();

            // Restaurer + convertir les valeurs
            foreach ($sessions as $s) {
                $statut = match ($s->statut) {
                    'active'   => 'actif',
                    'terminee' => 'inactif',
                    'annulee'  => 'inactif',
                    default    => $s->statut ?? 'actif',
                };

                DB::table('formations_sessions')->insert([
                    'id'               => $s->id,
                    'code'             => $s->code,
                    'titre'            => $s->titre,
                    'filiere_id'       => $s->filiere_id,
                    'formateur_id'     => $s->formateur_id,
                    'etablissement_id' => $s->etablissement_id,
                    'date_debut'       => $s->date_debut,
                    'date_fin'         => $s->date_fin,
                    'nb_places'        => $s->nb_places,
                    'description'      => $s->description,
                    'statut'           => $statut,
                    'expire_le'        => $s->expire_le ?? null,
                    'created_at'       => $s->created_at,
                    'updated_at'       => $s->updated_at,
                ]);
            }

            // ========== 2. RECRÉER affectations SANS CHECK ==========
            $affectations = DB::table('affectations')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('affectations');

            Schema::create('affectations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
                $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
                $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
                $table->date('date_debut');
                $table->date('date_fin')->nullable();
                $table->string('statut', 20)->default('actif'); // actif / inactif / suspendu
                $table->timestamps();
            });
            Schema::enableForeignKeyConstraints();

            foreach ($affectations as $a) {
                $statut = match ($a->statut) {
                    'termine'  => 'inactif',
                    'suspendu' => 'suspendu',
                    default    => $a->statut ?? 'actif',
                };

                DB::table('affectations')->insert([
                    'id'               => $a->id,
                    'formateur_id'     => $a->formateur_id,
                    'filiere_id'       => $a->filiere_id,
                    'etablissement_id' => $a->etablissement_id,
                    'date_debut'       => $a->date_debut,
                    'date_fin'         => $a->date_fin,
                    'statut'           => $statut,
                    'created_at'       => $a->created_at,
                    'updated_at'       => $a->updated_at,
                ]);
            }

            // ========== 3. RECRÉER formateurs SANS CHECK ==========
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
                $table->foreignId('filiere_id')->nullable()->constrained('filieres')->nullOnDelete();
                $table->string('statut', 20)->default('actif'); // actif / inactif / suspendu
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::enableForeignKeyConstraints();

            foreach ($formateurs as $f) {
                $statut = match ($f->statut) {
                    'en_attente' => 'actif',
                    default      => $f->statut ?? 'actif',
                };

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
                    'filiere_id'       => null,
                    'statut'           => $statut,
                    'created_at'       => $f->created_at,
                    'updated_at'       => $f->updated_at,
                    'deleted_at'       => $f->deleted_at,
                ]);
            }

            // ========== 4. REMPLIR filiere_id DEPUIS LE PIVOT ==========
            DB::statement("
                UPDATE formateurs
                SET filiere_id = (
                    SELECT filiere_id
                    FROM formateur_filieres
                    WHERE formateur_filieres.formateur_id = formateurs.id
                    LIMIT 1
                )
                WHERE filiere_id IS NULL
            ");

            // ========== 5. AJOUTER statut AUX etablissements ET filieres ==========
            if (!Schema::hasColumn('etablissements', 'statut')) {
                Schema::table('etablissements', function (Blueprint $table) {
                    $table->string('statut', 20)->default('actif')->after('email');
                });
            }

            if (!Schema::hasColumn('filieres', 'statut')) {
                Schema::table('filieres', function (Blueprint $table) {
                    $table->string('statut', 20)->default('actif')->after('description');
                });
            }
        } else {
            // MySQL : ALTER simple
            Schema::table('etablissements', function (Blueprint $table) {
                if (!Schema::hasColumn('etablissements', 'statut')) {
                    $table->string('statut', 20)->default('actif');
                }
            });
            Schema::table('filieres', function (Blueprint $table) {
                if (!Schema::hasColumn('filieres', 'statut')) {
                    $table->string('statut', 20)->default('actif');
                }
            });
            Schema::table('formateurs', function (Blueprint $table) {
                if (!Schema::hasColumn('formateurs', 'filiere_id')) {
                    $table->foreignId('filiere_id')->nullable()->after('etablissement_id')
                          ->constrained('filieres')->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        // Pas de rollback
    }
};
