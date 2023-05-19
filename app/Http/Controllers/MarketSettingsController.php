<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketSettings;
use Illuminate\Support\Facades\DB; 



class MarketSettingsController extends Controller
{
    public function index()
    {
        return DB::select('SELECT * FROM "market_settings"');
    }

  
}