<?php

use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\AdminLoginController;
use Illuminate\Http\Request;
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

Route::post('/login', AdminLoginController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('abilities:server:admin')->group(function () {
        Route::apiResources([
            'achievements' => AchievementController::class,
        ]);
    });
});
