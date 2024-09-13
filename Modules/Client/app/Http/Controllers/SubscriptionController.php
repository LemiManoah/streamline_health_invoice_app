<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Client\Models\Subscription;
use Illuminate\Support\Facades\Notification;
use Modules\Client\Notifications\SubscriptionNotification;

class SubscriptionController extends Controller
{
    
    public function create()
    {   
        $clients = Client::all(); // Fetch clients to associate with the subscription
        return view('client::subscriptions.create', compact('clients'));
    }

    
    /**
     * Store a newly created subscription in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plan_name' => 'required|string|max:255',
            'billing_cycle_in_years' => 'required|integer', // Make sure this matches the input type and constraints
            'start_date' => 'required|date',
            'next_billing_date' => 'required|date|after_or_equal:start_date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
        ]);

        $existingSubscription = Subscription::where('client_id', $validatedData['client_id'])->first();

        if ($existingSubscription) {
            return redirect()->back()->withErrors('This client already has an existing subscription.');
        }
        
         // Create the subscription
         $subscription = Subscription::create($validatedData);
          // Find the client
        $client = Client::find($validatedData['client_id']);
         // Notify client about the new subscription
        $client->notify(new SubscriptionNotification($subscription));

        // Redirect to the subscriptions index page
        return redirect()->route('clients.index')->with('success', 'Client Subscription created successfully.');

    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('client::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('client::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)   
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
