<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('notifications');

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('titre');
            $table->text('message');
            $table->enum('type', ['info', 'success', 'warning', 'danger'])->default('info');
            $table->string('icone')->default('notifications');
            $table->boolean('lu')->default(false);
            $table->string('lien')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();

            $table->index(['lu', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};