<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filiere_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->string('libelle');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filiere_options');
    }
};