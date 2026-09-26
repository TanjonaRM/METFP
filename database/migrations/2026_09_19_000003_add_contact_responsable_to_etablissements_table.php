<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('etablissements', function (Blueprint $table) {
            if (!Schema::hasColumn('etablissements', 'contact_responsable')) {
                $table->string('contact_responsable', 150)
                      ->nullable()
                      ->after('telephone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('etablissements', function (Blueprint $table) {
            if (Schema::hasColumn('etablissements', 'contact_responsable')) {
                $table->dropColumn('contact_responsable');
            }
        });
    }
};