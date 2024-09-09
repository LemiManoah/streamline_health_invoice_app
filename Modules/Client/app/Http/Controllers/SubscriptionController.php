<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Client\Models\Subscription;

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
            'billing_cycle' => ['required', Rule::in(['annually', 'biennially', 'triennially'])],
            'start_date' => 'required|date|after_or_equal:today',
            'amount' => 'required|numeric|min:0',
        ]);

        // Calculate the next billing date based on the billing cycle
        $nextBillingDate = $this->calculateNextBillingDate($validatedData['start_date'], $validatedData['billing_cycle']);

        
         // Create the subscription
         $subscription = Subscription::create([
            'client_id' => $validatedData['client_id'],
            'plan_name' => $validatedData['plan_name'],
            'billing_cycle' => $validatedData['billing_cycle'],
            'start_date' => $validatedData['start_date'],
            'next_billing_date' => $nextBillingDate,
            'amount' => $validatedData['amount'],
            'status' => 'active', // Default status
         ]);

        // Redirect to the subscriptions index page
        return redirect()->route('subscriptions.index')->with('success', 'Client Subscription created successfully.');

    }

    protected function calculateNextBillingDate($startDate, $billingCycle)
    {
        $date = \Carbon\Carbon::parse($startDate);

        switch ($billingCycle) {
            case 'annually':
                return $date->addYear()->toDateString();
            case 'biennially':
                return $date->addYears(2)->toDateString();
            case 'triennially':
                return $date->addYears(3)->toDateString();
            case '4_years':
                return $date->addYears(4)->toDateString();
            case '5_years':
                return $date->addYears(5)->toDateString();
            case '6_years':
                return $date->addYears(6)->toDateString();
            case '7_years':
                return $date->addYears(7)->toDateString();
            case '8_years':
                return $date->addYears(8)->toDateString();
            default:
                throw new \InvalidArgumentException("Invalid billing cycle: {$billingCycle}");
        }
    }
    public function getAmount(Request $request)
    {
        $billingCycle = $request->input('billing_cycle');

        // Define billing cycle amounts
        $billingCycleAmounts = [
            'annually' => 120000,     // Example amount for annually
            '2_years' => 230000,  
            '3_years' => 340000,
            '4_years' => 350000,
            '5_years' => 360000,
            '6_years' => 370000,
            '7_years' => 380000,
            '8_years' => 390000,
            
        ];

        // Determine the amount based on the selected billing cycle
        $amount = $billingCycleAmounts[$billingCycle] ?? 0;

        // Return the amount as JSON response
        return response()->json(['amount' => $amount]);
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
