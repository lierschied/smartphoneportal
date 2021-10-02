<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SmartphoneController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [SmartphoneController::class, 'index'])->name('index');

Route::name('shop.')->group(function () {
    Route::get('/shop', [SmartphoneController::class, 'index'])->name('index');
    Route::get('/shop/{smartphone}', [SmartphoneController::class, 'show'])->name('detail');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/smartphone/{smartphone}/rating/update', [RatingController::class, 'update'])
        ->name('smartphone.rating.update');

    Route::post('/comment/{comment}/like', [CommentController::class, 'like'])
        ->name('comment.like');
});
require __DIR__.'/auth.php';
