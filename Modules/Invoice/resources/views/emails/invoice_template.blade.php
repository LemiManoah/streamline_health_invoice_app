<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice #{{ $invoice->id }}</h1>
    <p>Greeting {{ $client->name }},</p>
    <p>Thank you for your business. Here are the details of your invoice:</p>
    <ul>
        <li>Invoice Number: {{ $invoice->id }}</li>
        <li>Total Amount: {{ $invoice->total_amount }}</li>
        <li>Due Date: {{ $invoice->due_date }}</li>
    </ul>
    <p>Please make the payment by the due date.</p>
</body>
</html>
