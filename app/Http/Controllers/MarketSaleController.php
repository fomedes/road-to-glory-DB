<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\User;



class MarketSaleController extends Controller

{
    public function store(Request $request)
    {

        $playerId = $request->input('player_id');
        $sellingClub = $request->input('selling_club');
        $sellingAmount = $request->input('selling_amount');
        $sellingDate = $request->input('selling_date');

        $clubPlayers = DB::table('users')
        ->where('userId', $sellingClub)
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
                Transfer::insert($soldPlayer);

                // Add sold player amount to funds
                $this->addFunds($soldPlayer);
                // Remove player from user
                $this->removePlayerFromClub($soldPlayer);
                // Mark player as Agente Libre
                $this->updatePlayerCurrentClub($soldPlayer);
                // Mark player as not a free agent
                $this->markPlayerFreeAgent($soldPlayer);
              

              return response()->json(['message' => 'Player sold successfully'], 200);

          }
        }
        return response()->json(['message' => 'Player not found'], 404);
    }    

    private function addFunds($soldPlayer)
    {
        $sellingClub = $soldPlayer['club'];
        $sellingAmount = $soldPlayer['amount'];

        $user = User::where('userId', $sellingClub)->first();
        if ($user) {
            $user->funds += $sellingAmount;
            $user->save();
        }
    }

    private function removePlayerFromClub($soldPlayer)
    {
        $sellingClub = $soldPlayer['club'];
        $playerId = $soldPlayer['player_id'];

        $user = User::where('userId', $sellingClub)->first();
        if ($user) {
            $clubPlayers = json_decode($user->club_players, true);
            $index = array_search($playerId, $clubPlayers);
        
            if ($index !== false) {
                array_splice($clubPlayers, $index, 1);
            }

            $user->club_players = json_encode($clubPlayers);
            $user->save();
        }
    }

    private function updatePlayerCurrentClub($soldPlayer)
    {
        $playerId = $soldPlayer['player_id'];

        $player = Player::find($playerId);
        if ($player) {
            $player->current_club = 'Agente Libre';
            $player->save();
        }
    }

    private function markPlayerFreeAgent($soldPlayer)
    {
        $playerId = $soldPlayer['player_id'];

        $player = Player::find($playerId);
        if ($player) {
            $player->isFreeAgent = true;
            $player->save();
        }
    }

}