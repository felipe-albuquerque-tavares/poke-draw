<?php

namespace App\Models;

use App\Enums\PokemonRarity;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $fillable = [
        'name',
        'types',
        'rarity',       
        'image',
        'description',
    ];

    protected $casts = [
        'types' => 'array',
        'rarity' => PokemonRarity::class, 
    ];
}
