<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 



class MarketSaleController extends Controller
{
    public function store(Request $request)
    {

        $playerId = $request->input('player_id');
        $sellingClub = $request->input('selling_club');
        $sellingAmount = $request->input('selling_amount');
        $sellingDate = $request->input('selling_date');

        $clubPlayers = DB::table('users')
        ->where('userID', $sellingClub)
        ->value('club_players');



        if ($clubPlayers) {
          $playerIds = json_decode($clubPlayers);

          if (in_array($playerId, $playerIds)) {
              $soldPlayer = [
                  'player_id' => $playerId,
                  'club' => $sellingClub,
                  'amount' => $sellingAmount,
                  'date' => $sellingDate,
                  'move_type' => 'sale'
              ];

              // Store the sold player data
              // Assuming you have a model named SoldPlayer to store the sold player information
              Transfer::insert($soldPlayer);

              return response()->json(['message' => 'Player sold successfully'], 200);
          }
      }

      return response()->json(['message' => 'Player not found'], 404);
  }
    

    private function findPlayerIndex($selectedPlayers, $playerId)
    {
        foreach ($selectedPlayers as $index => $player) {
            if ($player['player_id'] === $playerId) {
                return $index;
            }
        }

        return -1;
    }

    private function findSellingClubIndex($bids, $sellingClub)
    {
        foreach ($bids as $index => $bid) {
            if ($bid['sellingClub'] === $sellingClub) {
                return $index;
            }
        }

        return -1;
    }
  }
