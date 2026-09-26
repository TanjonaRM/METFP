<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nom');
            $table->enum('type', ['CFP', 'LTP', 'Lycee', 'Autre'])->default('CFP');
            $table->string('region')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};