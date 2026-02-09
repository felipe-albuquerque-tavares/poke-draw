<?php

namespace App\Data;

use App\Enums\PokemonRarity;
use App\Enums\PokemonType;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PokemonData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        /** @var array<PokemonType> */
        public array $types,
        public PokemonRarity $rarity,
        public ?string $image,
        public string $created_at,
        public string $updated_at,
    ) {}

    #[Computed]
    public function types_labels(): array
    {
        return array_map(fn (PokemonType $type) => $type->label(), $this->types);
    }

    #[Computed]
    public function rarity_label(): string
    {
        return $this->rarity->label();
    }
}
