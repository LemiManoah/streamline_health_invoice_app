<?php

namespace Modules\Invoice\Console;

use Illuminate\Console\Command;
use Modules\Invoice\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Modules\Client\Models\Subscription;
use Modules\Invoice\Emails\InvoiceMail;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateInvoice extends Command
{
    protected $signature = 'invoices:generate';
    protected $description = 'Generate invoices for subscriptions due for billing';

    public function handle()
    {
        $subscriptions = Subscription::where('next_billing_date', '<=', now())
                                     ->where('status', 'unpaid')
                                     ->get();

        foreach ($subscriptions as $subscription) {
            $invoice = new Invoice([
                'client_id' => $subscription->client_id,
                'subscription_id' => $subscription->id,
                'due_date' => now()->addDays(30), // Set due date to 30 days from now
                'total_amount' => $subscription->amount,
                'status' => 'unpaid'
            ]);

            $invoice->save();

            // Send invoice email
            Mail::to($subscription->client->email)->send(new InvoiceMail($invoice));

            // Update subscription's next billing date
            $subscription->next_billing_date = now()->addYears($subscription->billing_cycle_in_years);
            $subscription->save();
        }

        $this->info('Invoices generated and sent successfully.');
    }
}