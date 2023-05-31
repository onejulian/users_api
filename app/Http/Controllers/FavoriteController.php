<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user(); 
        
        $favorite = new Favorite();
        $favorite->id_user = $user->id;
        $favorite->character_name_favorite = $request->input('character_name_favorite');

        $character = Favorite::where('id_user', $user->id)->where('character_name_favorite', $request->input('character_name_favorite'))->first();
        if ($character) {
            return response()->json([
                'message' => 'El personaje ya se encuentra en favoritos.'
            ], 400);
        }

        $favorite->save();

        return response()->json([
            'message' => 'Favorito agregado exitosamente.'
        ]);
    }

    public function destroy(Request $request)
    {
        $user = auth()->user();
        $character = Favorite::where('id_user', $user->id)->where('character_name_favorite', $request->input('character_name_favorite'))->first();
        if (!$character) {
            return response()->json([
                'message' => 'El personaje no se encuentra en favoritos.'
            ], 400);
        }

        $character->delete();

        return response()->json([
            'message' => 'Favorito eliminado exitosamente.'
        ]);
    }

    public function index()
    {
        $user = auth()->user();
        $favorites = Favorite::where('id_user', $user->id)->get();

        return response()->json($favorites);
    }
}
