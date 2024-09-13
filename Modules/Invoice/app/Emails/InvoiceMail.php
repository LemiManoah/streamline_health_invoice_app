<?php

namespace Modules\Invoice\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice;
    public $client;

    /**
     * Create a new message instance.
     */
    public function __construct($invoice, $client)
    {
        $this->client = $client;
        $this->invoice = $invoice;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Mail',
        );
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'invoice::emails.invoice_mail',
            with: [
                'invoice' => $this->invoice,
                'client' => $this->client, 
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        // Generate the PDF in memory
        $pdf = Pdf::loadView('invoice::emails.invoice_template', ['invoice' => $this->invoice, 'client' => $this->client]);

        // Attach the PDF to the email
        return [
            Attachment::fromData(fn() => $pdf->output(), 'streamline_invoice.pdf')
                      ->withMime('application/pdf')
        ];
    
    }
}
