<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SlackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify-email/{id}/{hash}',[AuthController::class, 'verifyEmail'])
          ->middleware(['signed'])->name('verification.verify');

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::controller(SlackController::class)->group(function(){
    Route::get('auth/slack', 'redirectToSlack');
    Route::get('auth/slack/callback', 'handleSlackCallback');
});
