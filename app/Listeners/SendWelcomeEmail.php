<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\RegisterEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        dispatch(new RegisterEmailJob($event->user->id, $event->user->email));
    }
}
