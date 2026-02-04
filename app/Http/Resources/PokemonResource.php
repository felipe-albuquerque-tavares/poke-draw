<?php

namespace App\Http\Resources;

use App\Enums\PokemonType;
use Illuminate\Http\Resources\Json\JsonResource;

class PokemonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'types' => $this->types,
            'typeLabels' => collect($this->types)->map(
                fn (string $type) => PokemonType::from($type)->label()
            )->values(),
            'rarity' => $this->rarity->value,
            'rarityLabel' => $this->rarity->label(),
            'image' => $this->image,
            'createdAt' => $this->created_at->toISOString(),
        ];
    }
}
