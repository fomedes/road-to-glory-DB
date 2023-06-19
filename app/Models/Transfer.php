<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'transfers';

    protected $primaryKey = 'id';
    
    protected $fillable = [
      'player_id', 
      'club', 
      'amount', 
      'date', 
      'move_type'
    ];
}