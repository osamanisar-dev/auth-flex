<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/', function () {
    return view('email-verification');
});

Route::get('send-mail', function () {
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
    Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\EmailVeritficationMail($details));
    dd("Email is Sent.");
});

Route::get('/verify-email/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);
    if (! URL::hasValidSignature($request)) {
        abort(401, 'Invalid or expired verification link.');
    }

    if (! hash_equals((string) $hash, sha1($user->email))) {
        abort(403, 'Invalid hash.');
    }
    if (!$user->email_verified_at) {
        $user->email_verified_at = now();
        $user->save();
    }

    return redirect()->to(env('FRONTEND_URL') . '?' . http_build_query([
            'verified' => '1',
            'id' => $user->id,
            'email_verified_at' => $user->email_verified_at->toISOString()
        ]));
})->middleware(['signed'])->name('verification.verify');
