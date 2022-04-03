<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/** This uses Laravel 9 Route group controllers
 *  @see https://laravel.com/docs/9.x/routing#route-group-controllers
 */
Route::controller(User::class)->prefix('users')->name('users.')->group(function () {
    Route::get('', 'index')->name('index');
});
