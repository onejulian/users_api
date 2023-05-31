<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CharacterDetailController extends Controller
{
    public function show($id)
    {
        $response = Http::get("https://rickandmortyapi.com/api/character/{$id}");
        $character = $response->json();

        return response()->json($character);
    }
}
