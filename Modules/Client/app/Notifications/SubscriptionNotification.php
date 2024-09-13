<?php

namespace Modules\Client\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionNotification extends Notification
{
    use Queueable;
    protected $subscription;

    /**
     * Create a new notification instance.
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
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
        return (new MailMessage)
            ->subject('Subscription Created')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new subscription has been created for you.')
            ->line('Plan: ' . $this->subscription->plan_name)
            ->line('Billing Cycle: ' . $this->subscription->billing_cycle_in_years)
            ->line('Amount: ' . $this->subscription->amount)
            ->line('Start Date: ' . $this->subscription->start_date)
            ->line('Next Billing Date: ' . $this->subscription->next_billing_date)
            ->action('View Clients', url('/clients/' . $this->subscription->id))
            ->line('Thank you for using our service!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'subscription_id' => $this->subscription->id,
            'plan_name' => $this->subscription->plan_name,
            'billing_cycle' => $this->subscription->billing_cycle_in_years,
            'amount' => $this->subscription->amount,
        ];
    }
}
