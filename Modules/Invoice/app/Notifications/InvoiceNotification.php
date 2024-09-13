<?php

namespace Modules\Invoice\Notifications;

use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Invoice\Models\Invoice;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceNotification extends Notification
{
    use Queueable;
    protected $invoice;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {

        // Generate PDF
        $pdf = Pdf::loadView('invoice::pdf', ['invoice' => $this->invoice]);
        // Access the client's name through the relationship
        $clientName = $this->invoice->client->client_name;
        
        return (new MailMessage)
            ->subject('Your Invoice is Ready')
            ->greeting('Hello ' . $clientName . ',')
            ->line('Your invoice is attached to this email.')
            ->line('Invoice ID: ' . $this->invoice->id)
            ->attachData($pdf->output(), 'invoice_' . $this->invoice->id. '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [];
    }
}
