<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $token = Socialite::driver('google')->getAccessTokenResponse(request('code'));
            $user = Socialite::driver('google')->userFromToken($token['access_token']);
            $findUser = User::where('google_id', $user->id)->first();
            if ($findUser) {
                Auth::login($findUser);
                $accessToken = $findUser->createToken('google-login')->plainTextToken;
                $userData = [
                    'id' => $findUser->id,
                    'name' => $findUser->name,
                    'email' => $findUser->email,
                    'email_verified_at' => $findUser->email_verified_at
                ];
                $userJson = urlencode(json_encode($userData));
                return redirect(config('app.frontend_url') . "/?token={$accessToken}&user={$userJson}&auth=login");
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => null,
                    'email_verified_at' => $user->user['email_verified'] ? now() : null
                ]);
                $accessToken = $newUser->createToken('google-login')->plainTextToken;
                $userData = [
                    'id' => $newUser->id,
                    'name' => $newUser->name,
                    'email' => $newUser->email,
                    'email_verified_at' => $newUser->email_verified_at
                ];
                $userJson = urlencode(json_encode($userData));
                return redirect(config('app.frontend_url') . "?token={$accessToken}&user={$userJson}&auth=register");
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
