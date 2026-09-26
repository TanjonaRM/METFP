<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('formations_sessions', 'expire_le')) {
            Schema::table('formations_sessions', function (Blueprint $table) {
                $table->datetime('expire_le')->nullable()->after('statut');
            });
        }
    }

    public function down(): void
    {
        Schema::table('formations_sessions', function (Blueprint $table) {
            if (Schema::hasColumn('formations_sessions', 'expire_le')) {
                $table->dropColumn('expire_le');
            }
        });
    }
};