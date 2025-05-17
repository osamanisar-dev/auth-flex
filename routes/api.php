<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('register','register');
    Route::post('login','login');
});

Route::controller(AuthController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('logout','logout');
    Route::post('/email/verification-notification', 'sendEmailNotification');
});

// Verify the email
Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect(env('FRONTEND_URL'));
})->middleware(['signed'])->name('verification.verify');
