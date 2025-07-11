<?php

// app/Http/Controllers/DonutController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Donut;
use App\Models\Batter;
use App\Models\Topping;

class DonutController extends Controller
{
    // Fetch from API and store in DB
    public function fetchAndStore()
    {
        $url = 'https://repocodes.s3.amazonaws.com/interview.json';

        try {
            $response = Http::timeout(10)->get($url);

            if (!$response->successful()) {
                return back()->with('error', '❌ Oops! API request failed. Please try again later.');
            }

            $donutData = $response->json();

            foreach ($donutData as $item) {
                $donut = Donut::updateOrCreate(
                    ['api_id' => $item['id']],
                    ['type' => $item['type'], 'name' => $item['name'], 'ppu' => $item['ppu']]
                );

                foreach ($item['batters']['batter'] as $batter) {
                    Batter::updateOrCreate(
                        ['api_id' => $batter['id'], 'donut_id' => $donut->id],
                        ['type' => $batter['type']]
                    );
                }

                foreach ($item['topping'] as $topping) {
                    Topping::updateOrCreate(
                        ['api_id' => $topping['id'], 'donut_id' => $donut->id],
                        ['type' => $topping['type']]
                    );
                }
            }

            return back()->with('success', '✅ Data successfully fetched from the API.');
        } catch (\Exception $e) {
            return back()->with('error', '❌ Failed to fetch data. Check your internet connection.');
        }
    }


    // Display donuts from DB
    public function index(Request $request)
    {
        $search = $request->input('search');

        $donuts = Donut::with(['batters', 'toppings'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('batters', fn($q) => $q->where('type', 'LIKE', "%{$search}%"))
                    ->orWhereHas('toppings', fn($q) => $q->where('type', 'LIKE', "%{$search}%"));
            })
            ->paginate(6);

        return view('index', compact('donuts', 'search'));
    }
}
