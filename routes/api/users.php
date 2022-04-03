<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::controller(User::class)->prefix('users')->name('users.')->group(function () {
    Route::get('', 'index')->name('index');
});
