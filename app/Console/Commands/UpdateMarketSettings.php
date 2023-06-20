<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\MarketSettings;
use App\Models\MarketAuction;
use App\Models\Player;
use App\Models\Transfer;
use App\Models\User;
use Carbon\Carbon;


class UpdateMarketSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'market:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update market settings, players and process winner bids';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings = MarketSettings::firstOrFail();
        $auction = MarketAuction::firstOrFail();
    
        if ($this->isAuctionExpired($settings)) {
            $this->processBids($auction);
            $this->randomizeNewPlayers($settings, $auction);
        }
    }
    
    private function isAuctionExpired($settings)
    {
        $endDateTimezone = new \DateTimeZone('Europe/London');
        $endDateTime = new \DateTime($settings->end_date, $endDateTimezone);
        $endDate = Carbon::instance($endDateTime);
        
        // Check if deadline ahs been reached
        if ($endDate->isPast()) {
            $start = Carbon::now('Europe/London');
            $end = Carbon::now('Europe/London');
            $settings->start_date = $start;
            $settings->end_date = $end->addMinutes(2);
            $settings->save();
    
            return true;
        }
    
        return false;
    }
    
    private function processBids($auction)
    {
        $auctionContent = DB::table('market_auction')->get();

        // Check bid winners
        foreach ($auctionContent as $row) {
            if (!empty($row->selected_players)) {
                $selectedPlayers = json_decode($row->selected_players, true);
                $finalBids = [];
    
                // Get selected_players from each community
                foreach ($selectedPlayers as $player) {
                    $bids = $player['bids'];
                    $playerId = $player['player_id'];
    
                    // If player bids is not empty
                    if (!empty($bids)) {
                        $winnerBid = $this->findWinnerBid($bids, $playerId);
                        $finalBids[] = $winnerBid;
                    }
                }
    
                if (!empty($finalBids)) {
                    // Store the finalBids in the transfers table
                    Transfer::insert($finalBids);
                    
                     foreach ($finalBids as $bid) {
                        // Deduct bid amount from funds
                        $this->deductFunds($bid);
                        // Add player to winner user
                        $this->addPlayerToClub($bid);
                        // Update player's current club
                        $this->updatePlayerCurrentClub($bid);
                        // Mark player as not a free agent
                        $this->markPlayerNotFreeAgent($bid);
                    }
                }
            }
        }
    
        $this->info('Bids processed successfully!');
    }
    
    private function findWinnerBid($bids, $playerId)
    {
        $winnerBid = null;
    
        // Compare all bids received to keep older largest bid
        foreach ($bids as $bid) {
            if (isset($bid['biddingAmount']) && isset($bid['biddingClub']) && isset($bid['biddingDate'])) {
                $playerId = $bid['player_id'];
                $biddingClub = $bid['biddingClub'];
                $biddingAmount = (int) $bid['biddingAmount'];
                $biddingDate = Carbon::parse($bid['biddingDate']);
                $user = User::where('userId', $biddingClub)->first();
                if ($user) {
                    $username = $user->username;
                }
                $player = Player::where('id', $playerId)->first();
                if ($player) {
                    $playerName = $player->short_name;
                }
        
    
                if ($winnerBid === null) {
                    $winnerBid = [
                        'player_id' => $playerId,
                        'player_name' => $playerName,
                        'club' => $biddingClub,
                        'username' => $username,
                        'amount' => $biddingAmount,
                        'date' => $biddingDate,
                        'move_type' => 'purchase'
                    ];
                } else {
                    $currentAmount = $winnerBid['amount'];

                    if ($biddingAmount > $currentAmount) {
                        $winnerBid = [
                            'player_id' => $playerId,
                            'player_name' => $playerName,
                            'club' => $biddingClub,
                            'username' => $username,
                            'amount' => $biddingAmount,
                            'date' => $biddingDate,
                            'move_type' => 'purchase'
                        ];
                    }
                }
            }
        }
    
        return $winnerBid;
    }
    
    // Randomize new players
    private function randomizeNewPlayers($settings, $auction)
    {
        $players = Player::where('isFreeAgent', true)
            ->whereBetween('overall', [$settings->minimum_overall, $settings->maximum_overall])
            ->inRandomOrder()
            ->take(10)
            ->get()
            ->map(function ($player) {
                return [
                    'player_id' => $player->id,
                    'bids' => []
                ];
            });
    
        $auction->selected_players = $players;
        $auction->save();
    }

    private function deductFunds($bid)
    {
        $biddingClub = $bid['club'];
        $biddingAmount = $bid['amount'];

        $user = User::where('userId', $biddingClub)->first();
        if ($user) {
            $user->funds -= $biddingAmount;
            $user->save();
        }
    }

    private function addPlayerToClub($bid)
    {
        $biddingClub = $bid['club'];
        $playerId = $bid['player_id'];

        $user = User::where('userId', $biddingClub)->first();
        if ($user) {
            $clubPlayers = json_decode($user->club_players, true);
            $clubPlayers[] = $playerId;
            $user->club_players = json_encode($clubPlayers);
            $user->save();
        }
    }

    private function updatePlayerCurrentClub($bid)
    {
        $playerId = $bid['player_id'];
        $biddingClub = $bid['club'];

        $user = User::where('userId', $biddingClub)->first();
        if ($user) {
            $username = $user->username;
        }


        $player = Player::find($playerId);
        if ($player) {
            $player->current_club = $username;
            $player->save();
        }
    }

    private function markPlayerNotFreeAgent($bid)
    {
        $playerId = $bid['player_id'];

        $player = Player::find($playerId);
        if ($player) {
            $player->isFreeAgent = false;
            $player->save();
        }
    }
}
