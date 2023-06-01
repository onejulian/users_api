<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterDetailController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['cors'])->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware(['auth:sanctum', 'cors'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/characters/page/{page}', [CharacterController::class, 'index'])->name('characters.index');
    Route::get('/characters/{id}', [CharacterDetailController::class, 'show'])->name('characters.show');
    Route::put('/user/update-more-info', [UserController::class, 'updateMoreInfo'])->name('user.updateMoreInfo');
});
