<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->get('/pokemons', [PokemonController::class, 'index']);

Route::middleware(['web', 'auth'])->get('/random-pokemon', [PokemonController::class, 'random']);
