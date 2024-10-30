<h1>New Invoice for Your Subscription</h1>
<p>Dear {{ $invoice->client->name }},</p>
<p>A new invoice has been generated for your subscription.</p>
<p>Invoice Details:</p>
<ul>
    <li>Invoice Number: {{ $invoice->id }}</li>
    <li>Due Date: {{ $invoice->due_date }}</li>
    <li>Amount: ${{ number_format($invoice->total_amount, 2) }}</li>
</ul>
<p>Please ensure payment is made by the due date.</p>
