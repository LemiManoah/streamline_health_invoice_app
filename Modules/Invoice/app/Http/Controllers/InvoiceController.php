<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use Modules\Invoice\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Invoice\Http\Requests\InvoiceRequest;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice::index', compact('invoices'));
    }

    public function dummy()
    {
        $invoices = [
            ['id' => 'INV-001', 'customer' => 'John Doe', 'dueDate' => '2023-06-15', 'total' => 1500.0, 'status' => 'Paid'],
            ['id' => 'INV-002', 'customer' => 'Jane Smith', 'dueDate' => '2023-07-01', 'total' => 750.0, 'status' => 'Overdue'],
            ['id' => 'INV-003', 'customer' => 'Bob Johnson', 'dueDate' => '2023-08-01', 'total' => 2000.0, 'status' => 'Pending'],
            ['id' => 'INV-004', 'customer' => 'Alice Williams', 'dueDate' => '2023-09-01', 'total' => 1200.0, 'status' => 'Paid'],
            ['id' => 'INV-005', 'customer' => 'Tom Davis', 'dueDate' => '2023-10-01', 'total' => 900.0, 'status' => 'Overdue'],
        ];

        return view('invoice::dashboard', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('invoice::create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number',
            'client_name' => 'required|string|max:255',
            'due_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
        ]);
        // Fetch the latest invoice number and increment it
        $latestInvoice = Invoice::orderBy('id', 'desc')->first();
        $nextInvoiceNumber = $latestInvoice ? intval(substr($latestInvoice->invoice_number, 4)) + 1 : 1;

        // Format the new invoice number as INV-001, INV-002, etc.
        $formattedInvoiceNumber = 'INV-' . str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);

        // Create the invoice
        Invoice::create([
            'client_id' => $request->client_id,
            'invoice_number' => $formattedInvoiceNumber,
            'client_name' => $request->client_name,
            'due_date' => $request->due_date,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
        ]);

        // Redirect to the invoices index page with a success message
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoice::show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $clients = Client::all();
        return view('invoice::edit', compact('invoice', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number,' . $invoice->id,
            'client_name' => 'required|string|max:255',
            'due_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
        ]);

        // Update the invoice
        $invoice->update($request->all());

        // Redirect to the invoices index page with a success message
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        // Redirect to the invoices index page with a success message
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
