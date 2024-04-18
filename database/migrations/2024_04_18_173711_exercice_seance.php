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
        Schema::create('exercice_seance', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('exercice_id')
                ->constrained('exercices')
                ->onDelete('cascade');

            $table->foreignId('seance_id')
                ->constrained('seances')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');

            $table->integer('number_of_reps')->nullable();
            $table->integer('number_of_series')->nullable();
            $table->double('weight')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercice_seance');
    }
};
