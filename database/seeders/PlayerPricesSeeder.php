<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\PlayerPrices;

class PlayerPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlayerPrices::Create([
            'community' => 1,
            '40'=> 500000,
            '41'=> 500000,
            '42'=> 500000,
            '43'=> 500000,
            '44'=> 500000,
            '45'=> 500000,
            '46'=> 500000,
            '47'=> 500000,
            '48'=> 500000,
            '49'=> 500000,
            '50'=> 500000,
            '51'=> 500000,
            '52'=> 500000,
            '53'=> 500000,
            '54'=> 500000,
            '55'=> 500000,
            '56'=> 500000,
            '57'=> 500000,
            '58'=> 500000,
            '59'=> 500000,
            '60'=> 500000,
            '61'=> 500000,
            '62'=> 500000,
            '63'=> 500000,
            '64'=> 500000,
            '65'=> 500000,
            '66'=> 500000,
            '67'=> 500000,
            '68'=> 500000,
            '69'=> 500000,
            '70'=> 1000000,
            '71'=> 2000000,
            '72'=> 3000000,
            '73'=> 4000000,
            '74'=> 5000000,
            '75'=> 7500000,
            '76'=> 11000000,
            '77'=> 15500000,
            '78'=> 19000000,
            '79'=> 23000000,
            '80'=> 28000000,
            '81'=> 33000000,
            '82'=> 38000000,
            '83'=> 43000000,
            '84'=> 50000000,
            '85'=> 57500000,
            '86'=> 65000000,
            '87'=> 72500000,
            '88'=> 80000000,
            '89'=> 87500000,
            '90'=> 95000000,
            '91'=> 95000000,
            '92'=> 95000000,
            '93'=> 95000000,
            '94'=> 95000000,
            '95'=> 95000000,
            '96'=> 95000000,
            '97'=> 95000000,
            '98'=> 95000000,
            '99'=> 95000000
            ]);
        } 
}
