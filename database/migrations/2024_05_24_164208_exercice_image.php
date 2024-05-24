<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercice_image', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('exercice_id')
                ->constrained('exercices')
                ->onDelete('cascade');

            $table->foreignId('image_id')
                ->constrained('images')
                ->onDelete('cascade');

            $table->integer('number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercice_image');
    }
};
