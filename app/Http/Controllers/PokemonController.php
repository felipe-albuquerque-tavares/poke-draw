<?php

namespace App\Http\Controllers;

use App\Data\PokemonData;
use App\Enums\PokemonRarity;
use App\Enums\PokemonType;
use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $pokemons = Pokemon::whereHas('users', function ($q) use ($user) {
            $q->where('users.id', $user->id);
        })
            ->when($request->filled('name'), function ($q) use ($request) {
                $q->where('name', 'LIKE', '%'.$request->query('name').'%');
            })
            ->get()
            ->map(function ($pokemon) {
                return new PokemonData(
                    id: $pokemon->id,
                    name: $pokemon->name,
                    types: array_map(fn ($t) => PokemonType::from($t), $pokemon->types),
                    rarity: $pokemon->rarity,
                    image: $pokemon->image,
                    created_at: $pokemon->created_at->toISOString(),
                    updated_at: $pokemon->updated_at->toISOString(),
                );
            });

        return response()->json($pokemons);
    }

    public function random()
    {
        $user = Auth::user();
        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

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
        }, 0);

        $types = collect($data['types'])
            ->pluck('type.name')
            ->map(fn ($type) => PokemonType::from($type)->value)
            ->values()
            ->toArray();
        $pokemon = Pokemon::updateOrCreate(
            ['id' => $data['id']],
            [
                'name' => $data['name'],
                'types' => $types,
                'rarity' => $this->determineRarity($baseStatTotal),
                'image' => $data['sprites']['front_default'],
            ]
        );
        $user->pokemons()->attach([$pokemon->id]);

        return new PokemonResource($pokemon);
    }

    private function determineRarity(int $baseStatTotal): PokemonRarity
    {
        if ($baseStatTotal >= 600) {
            return PokemonRarity::Legendary;
        }
        if ($baseStatTotal >= 500) {
            return PokemonRarity::Rare;
        }
        if ($baseStatTotal >= 400) {
            return PokemonRarity::Uncommon;
        }

        return PokemonRarity::Common;
    }
}
