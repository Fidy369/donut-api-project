<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Donut;
use App\Models\Batter;
use App\Models\Topping;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $url = 'https://repocodes.s3.amazonaws.com/interview.json';
        $data = Http::get($url)->json();

        foreach ($data as $item) {
            $donut = Donut::create([
                'api_id' => $item['id'],
                'type' => $item['type'],
                'name' => $item['name'],
                'ppu' => $item['ppu'],
            ]);

            foreach ($item['batters']['batter'] as $batter) {
                Batter::create([
                    'api_id' => $batter['id'],
                    'type' => $batter['type'],
                    'donut_id' => $donut->id,
                ]);
            }

            foreach ($item['topping'] as $topping) {
                Topping::create([
                    'api_id' => $topping['id'],
                    'type' => $topping['type'],
                    'donut_id' => $donut->id,
                ]);
            }
        }

        echo "✅ Donuts seeded successfully.\n";
    }
}

