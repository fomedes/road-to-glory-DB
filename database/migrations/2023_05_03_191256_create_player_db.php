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
        Schema::create('player_db', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('photo');
            $table->string('short_name');
            $table->integer('age');
            $table->integer('height');
            $table->integer('weight');
            $table->string('pref_position');
            $table->string('country');
            $table->integer('overall');
            $table->integer('potential');
            $table->integer('crossing');
            $table->integer('finishing');
            $table->integer('heading_accuracy');
            $table->integer('short_passing');
            $table->integer('volleys');
            $table->integer('dribbling');
            $table->integer('curve');
            $table->integer('free_kick');
            $table->integer('long_passing');
            $table->integer('ball_control');
            $table->integer('acceleration');
            $table->integer('sprint');
            $table->integer('agility');
            $table->integer('reactions');
            $table->integer('balance');
            $table->integer('shot_power');
            $table->integer('jumping');
            $table->integer('stamina');
            $table->integer('strength');
            $table->integer('long_shot');
            $table->integer('aggression');
            $table->integer('interceptions');
            $table->integer('positioning');
            $table->integer('vision');
            $table->integer('penalties');
            $table->integer('composure');
            $table->integer('defense_awareness');
            $table->integer('standing_tackle');
            $table->integer('sliding_tackle');
            $table->integer('gk_diving');
            $table->integer('gk_handling');
            $table->integer('gk_kicking');
            $table->integer('gk_positioning');
            $table->integer('gk_reflexes');
            $table->string('traits');
            $table->string('preferred_foot');
            $table->integer('weak_foot');
            $table->integer('skill_moves');
            $table->string('attacking_WR');
            $table->string('defensive_WR');
            $table->string('body_type');
            $table->boolean('real_face');
            $table->string('current_club')->default('Agente Libre');
            $table->boolean('isFreeAgent')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_db');
    }
};
