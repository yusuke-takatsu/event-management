<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Event\FetchEventListController;
use App\Http\Controllers\Event\StoreEventController;
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
Route::post('/login', LoginController::class)->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');

    // イベント
    Route::prefix('/event')->group(function () {
        Route::get('/', FetchEventListController::class)->name('index');
        Route::post('/', StoreEventController::class)->name('store');
    });
});
