<?php

namespace App\Http\Controllers;

use App\Services\SlackAuthService;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class SlackController extends Controller
{
    protected $slackAuthService;

    public function __construct(SlackAuthService $slackAuthService)
    {
        $this->slackAuthService = $slackAuthService;
    }

    public function redirectToSlack()
    {
        return Socialite::driver('slack')->redirect();
    }

    public function handleSlackCallback()
    {
        try {
            $data = $this->slackAuthService->handleSlackCallback();
            $userJson = urlencode(json_encode($data['user']));
            return redirect(config('app.frontend_url') . "/?token={$data['token']}&user={$userJson}&auth={$data['auth_type']}");
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
