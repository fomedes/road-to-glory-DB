<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


class MarketSaleController extends Controller

{
    public function store(Request $request)
    {

        $playerId = $request->input('player_id');
        $sellingClub = 1;
        $sellingAmount = $request->input('selling_amount');
        $sellingDate = $request->input('selling_date');

        $clubPlayers = DB::table('users')
        ->where('userId', $sellingClub)
        ->value('club_players');

        return response()->json(['message' => $clubPlayers], 200);

        if ($clubPlayers) {
          $playerIds = json_decode($clubPlayers);
/*
          if (in_array($playerId, $playerIds)) {
              $soldPlayer = [
                  'player_id' => $playerId,
                  'club' => $sellingClub,
                  'amount' => $sellingAmount,
                  'date' => $sellingDate,
                  'move_type' => 'sale'
              ];
*/
              // Store the sold player data
              //Transfer::insert($soldPlayer);

          }
        }
       // return response()->json(['message' => 'Player not found'], 404);
    }    

