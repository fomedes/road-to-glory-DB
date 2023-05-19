<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\MarketSettings;
use Carbon\Carbon;

class MarketSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MarketSettings::Create([
            'community' => 1,
            'minimum_overall' => 65,
            'maximum_overall' => 70,
            'market_duration' => 1,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMinutes(1),
        ]);
        }    
}
