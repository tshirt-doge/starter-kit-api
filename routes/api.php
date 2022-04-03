<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** API routes V1 **/
Route::prefix('v1')->group(function () {
    // Auth routes
    Route::group([], base_path('routes/api/auth.php'));

    // Users routes
    Route::group([], base_path('routes/api/users.php'));
});
