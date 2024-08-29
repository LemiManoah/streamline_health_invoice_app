<?php

namespace Modules\Client\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;
  
class VerifyClientEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
  
    public $client_email;
    public $client;
    /**
     * Create a new message instance.
     */
    public function __construct( $client)
    {
        $this->client = $client;
        // $this->client_email = $client_email;
    }
  
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify client email',
        );
    }
  
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'client::verification.verify-client-email',
            with: [
                'client' => $this->client, 
            ],
        );
    }
  
    /**
     * Get the attachments for the message.
     *
     * @return array

     */
    public function attachments(): array
    {
        return [
            Attachment::fromStorage('C:\Users\lemi\Downloads\Documents\Invoicingapp.pdf'),
        ];
    }
}
