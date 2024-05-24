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
        Schema::table('exercices', function (Blueprint $table) {
            $table->string('level')->nullable();
            $table->string('force')->nullable();
            $table->string('equipment')->nullable();
            $table->json('primary_muscles')->nullable();
            $table->json('secondary_muscles')->nullable();
            $table->json('instructions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exercices', function (Blueprint $table) {
            $table->dropColumn([
                'level',
                'force',
                'equipment',
                'primary_muscles',
                'secondary_muscles',
            ]);
        });
    }
};
