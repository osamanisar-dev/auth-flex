<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
