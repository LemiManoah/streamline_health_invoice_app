<h1>Reminder: Invoice Payment Due</h1>
<p>Dear {{ $invoice->client->name }},</p>
<p>This is a reminder that payment for invoice #{{ $invoice->id }} is due soon.</p>
<p>Invoice Details:</p>
<ul>
    <li>Invoice Number: {{ $invoice->id }}</li>
    <li>Due Date: {{ $invoice->due_date}}</li>
    <li>Amount: ${{ number_format($invoice->total_amount, 2) }}</li>
</ul>
<p>Please ensure payment is made as soon as possible to avoid any service interruptions.</p>