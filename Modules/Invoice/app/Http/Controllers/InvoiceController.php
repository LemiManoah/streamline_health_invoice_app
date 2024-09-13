<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use Modules\Invoice\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Client\Models\Subscription;
use Modules\Invoice\Http\Requests\InvoiceRequest;
use Modules\Invoice\Notifications\InvoiceNotification;

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
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $clients = Client::all();
    //     return view('invoice::create', compact('clients'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'client_id' => 'required|exists:clients,id',
    //         'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number',
    //         'due_date' => 'required|date',
    //         'total_amount' => 'required|numeric|min:0',
    //         'status' => 'required|in:paid,unpaid',
    //     ]);
    //     // Fetch the latest invoice number and increment it
    //     $latestInvoice = Invoice::orderBy('id', 'desc')->first();
    //     $nextInvoiceNumber = $latestInvoice ? intval(substr($latestInvoice->invoice_number, 4)) + 1 : 1;

    //     // Format the new invoice number as INV-001, INV-002, etc.
    //     $formattedInvoiceNumber = 'INV-' . str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);

    //     // Create the invoice
    //     Invoice::create([
    //         'client_id' => $request->client_id,
    //         'invoice_number' => $formattedInvoiceNumber,
    //         'due_date' => $request->due_date,
    //         'total_amount' => $request->total_amount,
    //         'status' => $request->status,
    //     ]);

    //     // Redirect to the invoices index page with a success message
    //     return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    // }
    public function create()
    {
        $clients = Client::all();
        $subscriptions = Subscription::all();
        // $subscriptions = Subscription::where('client_id', $client->id)->get(); 

        return view('invoice::create', compact('clients', 'subscriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'total_amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $client = Client::findOrFail($request->client_id);

        // Generate the invoice number in the format INV-001
        $lastInvoice = Invoice::orderBy('id', 'desc')->first();
        $nextInvoiceNumber = 'INV-' . str_pad($lastInvoice ? $lastInvoice->id + 1 : 1, 3, '0', STR_PAD_LEFT);

        // Create new invoice
        $invoices = new Invoice();
        $invoices->invoice_number = $request->invoice_number;
        $invoices->client_id = $request->client_id;
        $invoices->subscription_id = $request->subscription_id;
        $invoices->total_amount = $request->total_amount;
        $invoices->due_date = $request->due_date;
        $invoices->status = $request->status;
        $invoices->save();

        // Send the notification
        // $client->notify(new InvoiceNotification($invoice));

        // Return the invoice preview
        return view('invoice::index', compact('invoices',  'client'));
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
            'subscription_id' => 'required|exists:subscription',
            'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number,' . $invoice->id,
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

    public function getAmount(Request $request)
    {
        $subscription = Subscription::find($request->subscription_id);

        if ($subscription) {
            return response()->json(['amount' => $subscription->amount]);
        } else {
            return response()->json(['error' => 'Subscription not found'], 404);
        }
    }

}
