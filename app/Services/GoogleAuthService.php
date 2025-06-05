<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthService
{
    public function handleGoogleCallback()
    {
        $token = Socialite::driver('google')->getAccessTokenResponse(request('code'));
        $user = Socialite::driver('google')->userFromToken($token['access_token']);
        $user = User::updateOrCreate(
            ['google_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->user['email_verified'] ? now() : null,
                'google_id' => $user->id,
            ]
        );
        Auth::login($user);
        $accessToken = $user->createToken('google-login')->plainTextToken;
        return [
            'token' => $accessToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at
            ],
            'auth_type' => $user->wasRecentlyCreated ? 'register' : 'login'
        ];
    }
}
