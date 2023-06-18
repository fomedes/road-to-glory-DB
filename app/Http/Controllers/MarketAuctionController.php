<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketAuction;
use Illuminate\Support\Facades\DB; 



class MarketAuctionController extends Controller
{
    public function index()
    {
        return DB::select('SELECT * FROM "market_auction"');
    }

    public function store(Request $request)
    {
        $playerId = $request->input('player_id');
        $biddingClub = $request->input('bidding_club');
        $biddingAmount = $request->input('bidding_amount');
        $biddingDate = $request->input('bidding_date');

        $existingBids = DB::table('market_auction')
            ->where('community', 1) // In the future, community will need to be filtered
            ->value('selected_players');

        $selectedPlayers = json_decode($existingBids, true);
        $playerIndex = $this->findPlayerIndex($selectedPlayers, $playerId);

        if ($playerIndex !== -1) {
            $bids = $selectedPlayers[$playerIndex]['bids'];

            $biddingClubIndex = $this->findBiddingClubIndex($bids, $biddingClub);

            if ($biddingClubIndex !== -1) {
                $bids[$biddingClubIndex]['biddingAmount'] = $biddingAmount;
                $bids[$biddingClubIndex]['biddingDate'] = $biddingDate;
            } else {
                $newBid = [
                    'biddingClub' => $biddingClub,
                    'biddingAmount' => $biddingAmount,
                    'biddingDate' => $biddingDate,
                    'move_type' => 'purchase'
                ];
                $bids[] = $newBid;
            }
            
            $selectedPlayers[$playerIndex]['bids'] = $bids;

            DB::table('market_auction')
                ->where('community', 1)
                ->update(['selected_players' => json_encode($selectedPlayers)]);

            return response()->json(['message' => 'Bid stored successfully'], 200);
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

    private function findBiddingClubIndex($bids, $biddingClub)
    {
        foreach ($bids as $index => $bid) {
            if ($bid['biddingClub'] === $biddingClub) {
                return $index;
            }
        }

        return -1;
    }
}