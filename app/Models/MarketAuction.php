<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Player;

class MarketAuction extends Model
{
    use HasFactory;

    protected $table = 'market_auction';

    protected $casts = [
        'selected_players' => 'array',
    ];

    protected $fillable = [
        'community',
        'selected_players'
    ];

    protected $primaryKey = 'community';

    }



