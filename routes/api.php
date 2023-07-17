<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CasinoController,
    PostController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('post', [PostController::class, 'postList']);
Route::get('post-prediction', [PostController::class, 'postPrediction']);
Route::get('post/{id}', [PostController::class, 'postDetails']);
Route::post('likes', [PostController::class, 'likes']);
Route::get('casino', [CasinoController::class, 'casinoList']);
Route::get('casino/{id}', [CasinoController::class, 'casinoDetails']);
Route::get('category', [CasinoController::class, 'categoryList']);
