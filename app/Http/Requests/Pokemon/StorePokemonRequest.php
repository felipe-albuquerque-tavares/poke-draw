<?php

namespace App\Concerns;

use App\Enums\PokemonRarity;
use App\Enums\PokemonType;
use Illuminate\Validation\Rules\Enum;

class StorePokemonRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'types' => ['required', 'array', 'min:1', 'max:2'],
            'types.*' => ['required', new Enum(PokemonType::class)],
            'rarity' => ['required', new Enum(PokemonRarity::class)],
            'stats.hp' => 'required|integer|min:1',
            'stats.attack' => 'required|integer|min:1',
            'stats.defense' => 'required|integer|min:1',
            'stats.spAttack' => 'required|integer|min:1',
            'stats.spDefense' => 'required|integer|min:1',
            'stats.speed' => 'required|integer|min:1',
            'image_url' => 'required|url',
        ];
    }
}
