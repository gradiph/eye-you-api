<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\GameController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('abilities:user')->group(function () {
        Route::get('profile', [ProfileController::class, 'index']);
        
        Route::prefix('game')->group(function () {
            Route::get('modes', [GameController::class, 'modes']);
            Route::post('start', [GameController::class, 'start']);
        });
    });
});
