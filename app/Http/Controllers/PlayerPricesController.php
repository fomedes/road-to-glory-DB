<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayerPrices;
use Illuminate\Support\Facades\DB; 


class PlayerPricesController extends Controller
{
    public function index()
    {
        return DB::select('SELECT * FROM "player_prices"');
    }

}