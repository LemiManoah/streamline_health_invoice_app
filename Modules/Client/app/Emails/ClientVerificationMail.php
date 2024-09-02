<?php

namespace Modules\Client\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Modules\Client\Models\Client;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $verificationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Client $client, string $verificationUrl)
    {
        $this->client = $client;
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Verify Your Email Address')
                    ->view('client::emails.verify')
                    ->with([
                        'verificationUrl' => $this->verificationUrl,
                    ]);
    }
}