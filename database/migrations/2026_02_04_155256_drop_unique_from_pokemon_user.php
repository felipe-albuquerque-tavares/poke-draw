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
        Schema::table('pokemon_user', function (Blueprint $table) {
            $table->dropUnique('pokemon_user_user_id_pokemon_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokemon_user', function (Blueprint $table) {
            $table->unique(['user_id', 'pokemon_id']);
        });
    }
};
