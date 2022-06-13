<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/** This uses Laravel 9 Route group controllers
 *  @see https://laravel.com/docs/9.x/routing#route-group-controllers
 */
Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::post('login', 'login')->name('login');
    Route::middleware(['auth:sanctum'])->post('logout', 'logout')->name('logout');
});
