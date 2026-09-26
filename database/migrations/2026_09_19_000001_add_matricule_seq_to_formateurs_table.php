<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matricule_sequences', function (Blueprint $table) {
            $table->id();
            $table->year('annee')->unique();
            $table->integer('derniere_valeur')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matricule_sequences');
    }
};
