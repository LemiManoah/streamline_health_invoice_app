<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use Modules\Invoice\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Modules\Client\Models\Subscription;
use Modules\Invoice\Emails\InvoiceMail;
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
    public function create()
    {
        $clients = Client::all();
        $subscriptions = Subscription::all();

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
         //get the client email
        $client_email = $client->client_email;
    
        // Create new invoice
        $invoice = new Invoice();
        $invoice->client_id = $request->client_id;
        $invoice->subscription_id = $request->subscription_id;
        $invoice->total_amount = $request->total_amount;
        $invoice->due_date = $request->due_date;
        $invoice->status = $request->status;
        $invoice->save();
    
        // Send an email to client with the invoice attached as PDF
        Mail::to($client_email)->send(new InvoiceMail($invoice));
        $invoices = Invoice::all();
        // Return the invoice preview
        return view('invoice::index', compact('invoice', 'invoices', 'client'));
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
        $subscriptions = Subscription::all();
        return view('invoice::edit', compact('invoice', 'clients', 'subscriptions'));
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
    public function search(Request $request)
    {
        $search = $request->input('search');

        //searching invoices by client name or invoice number
        $invoices = Invoice::where('status', 'like', "%{$search}%")
                    ->orWhereHas('client', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->get();

        return view('invoice::index', compact('invoices'));
    }

    public function getSubscriptionDetails(Request $request)
    {
        $subscription = Subscription::find($request->subscription_id);

        if ($subscription) {
            return response()->json([
                'amount' => $subscription->amount, 
                'due_date' => $subscription->next_billing_date->format('Y-m-d')
            ]);
        }

        return response()->json(['error' => 'Subscription not found'], 404);
    }

}