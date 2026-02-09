<?php

namespace App\Enums;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum PokemonType: string
{
    case Normal = 'normal';
    case Fire = 'fire';
    case Water = 'water';
    case Electric = 'electric';
    case Grass = 'grass';
    case Ice = 'ice';
    case Fighting = 'fighting';
    case Poison = 'poison';
    case Ground = 'ground';
    case Flying = 'flying';
    case Psychic = 'psychic';
    case Bug = 'bug';
    case Rock = 'rock';
    case Ghost = 'ghost';
    case Dragon = 'dragon';
    case Dark = 'dark';
    case Steel = 'steel';
    case Fairy = 'fairy';

    public function label(): string
    {
        return match ($this) {
            self::Normal => 'Normal',
            self::Fire => 'Fire',
            self::Water => 'Water',
            self::Electric => 'Electric',
            self::Grass => 'Grass',
            self::Ice => 'Ice',
            self::Fighting => 'Fighting',
            self::Poison => 'Poison',
            self::Ground => 'Ground',
            self::Flying => 'Flying',
            self::Psychic => 'Psychic',
            self::Bug => 'Bug',
            self::Rock => 'Rock',
            self::Ghost => 'Ghost',
            self::Dragon => 'Dragon',
            self::Dark => 'Dark',
            self::Steel => 'Steel',
            self::Fairy => 'Fairy',
        };
    }
}
