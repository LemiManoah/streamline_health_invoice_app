<?php

namespace Modules\Invoice\Console;

use Illuminate\Console\Command;
use Modules\Invoice\Emails\RemindersMail;
use Modules\Invoice\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendInvoiceReminders extends Command
{
    protected $signature = 'invoices:send-reminders';
    protected $description = 'Send reminders for unpaid invoices';

    public function handle()
    {
        $unpaidInvoices = Invoice::where('due_date', '<=', now()->addDays(7))
                                 ->where('status', 'unpaid')
                                 ->get();
       
        foreach ($unpaidInvoices as $invoice) {
            Mail::to($invoice->client->client_email)->send(new RemindersMail($invoice));
        }

        $this->info('Invoice reminders sent successfully.');
    }
}