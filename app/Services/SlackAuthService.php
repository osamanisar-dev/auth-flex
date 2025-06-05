<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SlackAuthService
{
    public function handleSlackCallback()
    {
        $token = Socialite::driver('slack')->getAccessTokenResponse(request('code'));
        $user = Socialite::driver('slack')->userFromToken($token['access_token']);
        $user = User::updateOrCreate(
            ['slack_id' => $user->id],
            [
                'name' => preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $user->name),
                'email' => $user->email,
                'email_verified_at' => $user->user['ok'] ? now() : null,
                'slack_id' => $user->id,
            ]
        );
        Auth::login($user);
        $accessToken = $user->createToken('slack-login')->plainTextToken;
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
