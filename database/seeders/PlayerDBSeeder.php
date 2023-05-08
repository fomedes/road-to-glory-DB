<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Player;

class PlayerDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = Storage::disk('local')->get('/json/sample.json');
        $players = json_decode($json, true);

        foreach ($players as $player) {
            Player::query()->updateOrCreate([
                'id' => $player['id'],
                'photo' => $player['photo'],
                'short_name' => $player['short_name'],
                'age' => $player['age'],
                'height' => $player['height'],
                'weight' => $player['weight'],
                'pref_position' => $player['pref_position'],
                'country' => $player['country'],
                'overall' => $player['overall'],
                'potential' => $player['potential'],
                'crossing' => $player['crossing'],
                'finishing' => $player['finishing'],
                'heading_accuracy' => $player['heading_accuracy'],
                'short_passing' => $player['short_passing'],
                'volleys' => $player['volleys'],
                'dribbling' => $player['dribbling'],
                'curve' => $player['curve'],
                'free_kick' => $player['free_kick'],
                'long_passing' => $player['long_passing'],
                'ball_control' => $player['ball_control'],
                'acceleration' => $player['acceleration'],
                'sprint' => $player['sprint'],
                'agility' => $player['agility'],
                'reactions' => $player['reactions'],
                'balance' => $player['balance'],
                'shot_power' => $player['shot_power'],
                'jumping' => $player['jumping'],
                'stamina' => $player['stamina'],
                'strength' => $player['strength'],
                'long_shot' => $player['long_shot'],
                'aggression' => $player['aggression'],
                'interceptions' => $player['interceptions'],
                'positioning' => $player['positioning'],
                'vision' => $player['vision'],
                'penalties' => $player['penalties'],
                'composure' => $player['composure'],
                'defense_awareness' => $player['defense_awareness'],
                'standing_tackle' => $player['standing_tackle'],
                'sliding_tackle' => $player['sliding_tackle'],
                'gk_diving' => $player['gk_diving'],
                'gk_handling' => $player['gk_handling'],
                'gk_kicking' => $player['gk_kicking'],
                'gk_positioning' => $player['gk_positioning'],
                'gk_reflexes' => $player['gk_reflexes'],
                'traits' => $player['traits'],
                'preferred_foot' => $player['preferred_foot'],
                'weak_foot' => $player['weak_foot'],
                'skill_moves' => $player['skill_moves'],
                'attacking_WR' => $player['attacking_WR'],
                'defensive_WR' => $player['defensive_WR'],
                'body_type' => $player['body_type'],
                'real_face' => $player['real_face']        
            ]);
        }    }
}
