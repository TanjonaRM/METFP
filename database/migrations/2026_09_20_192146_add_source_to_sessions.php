<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('formations_sessions', 'source')) {
            Schema::table('formations_sessions', function (Blueprint $table) {
                $table->string('source', 50)->default('admin')->after('statut');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('formations_sessions', 'source')) {
            Schema::table('formations_sessions', function (Blueprint $table) {
                $table->dropColumn('source');
            });
        }
    }
};