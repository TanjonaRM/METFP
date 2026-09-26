<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formateurs_users', function (Blueprint $table) {
            if (!Schema::hasColumn('formateurs_users', 'motif_refus')) {
                $table->text('motif_refus')->nullable()->after('statut');
            }
            if (!Schema::hasColumn('formateurs_users', 'valide_le')) {
                $table->timestamp('valide_le')->nullable()->after('motif_refus');
            }
            if (!Schema::hasColumn('formateurs_users', 'valide_par')) {
                $table->unsignedBigInteger('valide_par')->nullable()->after('valide_le');
            }
        });
    }

    public function down(): void
    {
        Schema::table('formateurs_users', function (Blueprint $table) {
            $table->dropColumn(['motif_refus', 'valide_le', 'valide_par']);
        });
    }
};