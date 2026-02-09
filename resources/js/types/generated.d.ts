declare namespace App.Data {
export type PokemonData = {
id: number;
name: string;
types: Array<App.Enums.PokemonType>;
rarity: App.Enums.PokemonRarity;
image: string | null;
created_at: string;
updated_at: string;
};
export type UserData = {
id: number;
name: string;
email: string;
created_at: string;
};
}
declare namespace App.Enums {
export type PokemonRarity = 'common' | 'uncommon' | 'rare' | 'legendary';
export type PokemonType = 'normal' | 'fire' | 'water' | 'electric' | 'grass' | 'ice' | 'fighting' | 'poison' | 'ground' | 'flying' | 'psychic' | 'bug' | 'rock' | 'ghost' | 'dragon' | 'dark' | 'steel' | 'fairy';
}
