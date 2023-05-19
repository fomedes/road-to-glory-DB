<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Player;

class MarketSettings extends Model
{
    use HasFactory;

    protected $table = 'market_settings';

    protected $casts = [
        'selected_players' => 'array',
        'starting_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected $fillable = [
        'community',
        'minimum_overall',
        'maximum_overall',
        'market_duration',
        'starting_date',
        'end_date',
        'selected_players',
    ];

    protected $primaryKey = 'community';

    }



