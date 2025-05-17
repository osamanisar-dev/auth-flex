<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVeritficationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $signedUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($signedUrl)
    {
        $this->signedUrl = $signedUrl;
    }

    public function build()
    {
        return $this->subject('Mail from AuthFlex')
            ->view('email-verification', ['signedUrl' => $this->signedUrl]);
    }
}
