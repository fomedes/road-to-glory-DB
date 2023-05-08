<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'player_db';

    protected $fillable = [
        'id',
        'photo',
        'short_name',
        'age',
        'height',
        'weight',
        'pref_position',
        'country',
        'overall',
        'potential',
        'crossing',
        'finishing',
        'heading_accuracy',
        'short_passing',
        'volleys',
        'dribbling',
        'curve',
        'free_kick',
        'long_passing',
        'ball_control',
        'acceleration',
        'sprint',
        'agility',
        'reactions',
        'balance',
        'shot_power',
        'jumping',
        'stamina',
        'strength',
        'long_shot',
        'aggression',
        'interceptions',
        'positioning',
        'vision',
        'penalties',
        'composure',
        'defense_awareness',
        'standing_tackle',
        'sliding_tackle',
        'gk_diving',
        'gk_handling',
        'gk_kicking',
        'gk_positioning',
        'gk_reflexes',
        'traits',
        'preferred_foot',
        'weak_foot',
        'skill_moves',
        'attacking_WR',
        'defensive_WR',
        'body_type',
        'real_face',
        'current_club',
        'isFreeAgent'
    ];

    protected $casts = [
        'pref_position' => 'array',
        'traits' => 'array',
    ];

    protected $primaryKey = 'id';

    public $incrementing = false;
}
