<?php

namespace App\Jobs;

use App\Mail\EmailVeritficationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class RegisterEmailJob implements ShouldQueue
{
    use Queueable;
    public $userId;
    public $userEmail;

    /**
     * Create a new job instance.
     */
    public function __construct($userId, $userEmail)
    {
        $this->userId = $userId;
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $signedUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(10),
            ['id' => $this->userId, 'hash' => sha1($this->userEmail)]
        );
        Mail::to($this->userEmail)->send(new EmailVeritficationMail($signedUrl));
    }
}
