<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\SmartphoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::name('api.smartphone.')->group(function() {
    Route::get('/smartphone/getFeatured', [SmartphoneController::class, 'getFeatured'])
        ->name('getFeatured');
});
Route::get('/comment/{comment}/likes', [LikeController::class, 'getLikesCount'])
    ->name('api.comment.like');
