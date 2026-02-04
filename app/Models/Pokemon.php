<?php

namespace App\Models;

use App\Enums\PokemonRarity;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $fillable = [
        'name',
        'types',
        'rarity' => PokemonRarity::class,
        'image_url',
        'description',
    ];

    protected $casts = [
        'types' => 'array',
    ];
}
