<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SlackController extends Controller
{
    public function redirectToSlack()
    {
        return Socialite::driver('slack')->redirect();
    }

    public function handleSlackCallback()
    {
        try {
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
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at
            ];
            $userJson = urlencode(json_encode($userData));
            return redirect(config('app.frontend_url') . "/?token={$accessToken}&user={$userJson}&auth=".($user->wasRecentlyCreated ? 'register':'login'));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
