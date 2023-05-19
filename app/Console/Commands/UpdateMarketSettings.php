<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MarketSettings;
use App\Models\Player;
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
    protected $description = 'Update market settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings = MarketSettings::firstOrFail();
        $start = Carbon::now('Europe/London');
        $end = Carbon::now('Europe/London');

        $endDateTimezone = new \DateTimeZone('Europe/London');
        $endDateTime = new \DateTime($settings->end_date, $endDateTimezone);
        $endDate = Carbon::instance($endDateTime);


        if ($endDate->isPast()) {
            $settings->start_date = $start;
            $settings->end_date = $end->addHours(1);


            $players = Player::whereBetween('overall', [$settings->minimum_overall, $settings->maximum_overall])
                ->inRandomOrder()
                ->take(10)
                ->get()
                ->map(function ($player) {
                    return [
                        'player_id' => $player->id,
                        'biding_club' => '',
                        'biding_amount' => 0,
                        'biding_date' => null,
                    ];
                });

            $settings->selected_players = $players;

            $settings->save();
        }
    }
}
