<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::controller(AuthController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('logout', 'logout');
});

