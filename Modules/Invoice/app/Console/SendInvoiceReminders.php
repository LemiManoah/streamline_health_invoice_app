<?php

namespace Modules\Invoice\Console;

use Illuminate\Console\Command;
use Modules\Invoice\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Modules\Invoice\Emails\InvoiceMail;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendInvoiceReminders extends Command
{
    protected $signature = 'invoices:send-reminders';
    protected $description = 'Send reminders for unpaid invoices';

    public function handle()
    {
        $unpaidInvoices = Invoice::where('status', 'unpaid')
                                 ->where('due_date', '<=', now()->addDays(7))
                                 ->get();
       
        foreach ($unpaidInvoices as $invoice) {
            Mail::to($invoice->client->email)->send(new InvoiceMail($invoice));
        }

        $this->info('Invoice reminders sent successfully.');
    }
}