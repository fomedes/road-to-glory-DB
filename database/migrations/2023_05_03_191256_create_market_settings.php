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
        Schema::create('market_settings', function (Blueprint $table) {
            $table->integer('community')->unique();
            $table->integer('minimum_overall');
            $table->integer('maximum_overall');
            $table->integer('market_duration');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->json('selected_players')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_settings');
    }
};
