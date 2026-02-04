<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function random()
    {
        $randomId = rand(1, 1025);

        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$randomId}");

        if ($response->failed()) {
            return response()->json([
                'error' => 'Failed to fetch Pokémon',
            ], 500);
        }

        $pokemon = $response->json();

        return response()->json([
            'id' => $pokemon['id'],
            'name' => $pokemon['name'],
            'image' => $pokemon['sprites']['front_default'],
            'types' => collect($pokemon['types'])->pluck('type.name'),
            'height' => $pokemon['height'],
            'weight' => $pokemon['weight'],
        ]);
    }
}
