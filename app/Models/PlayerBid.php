<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerBid extends Model
{
    protected $fillable = [
        'player_id',
        'bidding_club',
        'bidding_amount',
        'bidding_date',
        'move_type'
    ];

}
