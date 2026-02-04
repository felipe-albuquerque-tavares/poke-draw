<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Pokemon;
use App\Enums\PokemonRarity;
use App\Enums\PokemonType;
use App\Http\Resources\PokemonResource;

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
        $data = $response->json();

        $baseStatTotal = array_reduce($data['stats'], function ($carry, $item) {
            return $carry + $item['base_stat']; 
        },0);


        $types = collect($data['types'])
        ->pluck('type.name')
        ->map(fn ($type) => PokemonType::from($type)->value)
        ->values()
        ->toArray();
        print_r($this->determineRarity($baseStatTotal));
        $pokemon = Pokemon::updateOrCreate(
            ['id' => $data['id']], 
            [
                'name' => $data['name'],
                'types' => $types,
                'rarity' => $this->determineRarity($baseStatTotal),
                'image' => $data['sprites']['front_default'],
            ]
        );

        return new PokemonResource($pokemon);
    }

    private function determineRarity(int $baseStatTotal): PokemonRarity
    {
        if ($baseStatTotal >= 600) return PokemonRarity::Legendary;
        if ($baseStatTotal >= 500) return PokemonRarity::Rare;
        if ($baseStatTotal >= 400) return PokemonRarity::Uncommon;
        return PokemonRarity::Common;
    }
}
