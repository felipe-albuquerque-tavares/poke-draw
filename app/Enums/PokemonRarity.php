<?php

namespace App\Enums;

enum PokemonRarity: string
{
    case Common = 'common';
    case Uncommon = 'uncommon';
    case Rare = 'rare';
    case Legendary = 'legendary';

    public function label(): string
    {
        return match ($this) {
            self::Common => 'Common',
            self::Uncommon => 'Uncommon',
            self::Rare => 'Rare',
            self::Legendary => 'Legendary',
        };
    }
}
