<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CharacterController extends Controller
{
    public function index($page)
    {
        $response = Http::get("https://rickandmortyapi.com/api/character/?page={$page}");
        $characters = $response->json()['results'];

        return response()->json($characters);
    }
}
