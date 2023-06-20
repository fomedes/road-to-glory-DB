<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Transfer;
use Carbon\Carbon;

class TransfersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transfer::Create([
            'player_id' => 49486,
            'club' => 1,
            'username' => 'fomedes',
            'amount' => 1000000,
            'date' => Carbon::now(),
            'move_type' => 'purchase',
        ]);
        }    
}
