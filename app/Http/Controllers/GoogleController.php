<?php

namespace App\Http\Controllers;

use App\Services\GoogleAuthService;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    protected $googleAuthService;

    public function __construct(GoogleAuthService $googleAuthService)
    {
        $this->googleAuthService = $googleAuthService;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $data = $this->googleAuthService->handleGoogleCallback();
            $userJson = urlencode(json_encode($data['user']));
            return redirect(config('app.frontend_url') . "/?token={$data['token']}&user={$userJson}&auth={$data['auth_type']}");
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
