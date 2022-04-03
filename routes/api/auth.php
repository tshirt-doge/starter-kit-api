<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::post('login', 'login')->name('login');
    Route::middleware(['auth:sanctum'])->post('logout', 'logout')->name('logout');
});
