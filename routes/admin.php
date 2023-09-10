<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UploadFileController;
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

    Route::middleware('abilities:admin')->group(function () {

        Route::post('upload-file', UploadFileController::class);

        Route::prefix('tests/{test}')->group(function () {
            Route::apiResource('questions', QuestionController::class);
        });

        Route::apiResources([
            'achievements' => AchievementController::class,
            'tests' => TestController::class,
        ]);
    });
});
