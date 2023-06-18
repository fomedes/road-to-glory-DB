<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'transfers';

    protected $primaryKey = 'id';
    
    protected $fillable = [
      'player_id', 
      'bidding_club', 
      'bidding_amount', 
      'bidding_date', 
      'move_type'
    ];
}