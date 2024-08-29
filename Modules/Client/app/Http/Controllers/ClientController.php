<?php

namespace Modules\Client\Http\Controllers;

use Modules\Client\Models\Client;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Modules\Client\Emails\VerifyClientEmail;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Modules\Client\Http\Requests\CreateClientRequest;
use Illuminate\Http\RedirectResponse;



class ClientController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view clients', only: ['index', 'show']),
            new Middleware('permission:create clients', only: ['create', 'store']),
            new Middleware('permission:update clients', ['only' => ['edit', 'update']]),
            new Middleware('permission:delete clients', ['only' => ['destroy']]),
            // new Middleware('permission:view client history', ['only' => ['history']]),
            // new Middleware('permission:view client notes', ['only' => ['notes']]),
            // new Middleware('permission:view client files', ['only' => ['files']]),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();  // Fetch all clients
        return view('client::index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return view('client::create');
    }

    /**
     * Store a newly created resource in storage. **/
    public function store(CreateClientRequest $request): RedirectResponse
    {
        // Create the client with the validated data from the request
        $client = Client::create($request->validated());
    
        // Prepare and send the verification email
        Mail::to($client->email_for_invoices)->send(new VerifyClientEmail($client));
    
        // Optionally, fire the Registered event if needed
        // event(new Registered($client));
    
        // Redirect back to the clients index with a success message
        return redirect()->route('clients.index')->with('status', 'Client created successfully!');
    }
    


    /**
     * Show the specified resource.
     */
    public function show(Client $client)
    {
        return view('client::show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('client::edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateClientRequest $request, $id)
    {

        $client = Client::find($id);
        $client->update($request->validated());
        return redirect()->route('clients.index')->with('status','Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('status','Deleted successfully');
    }
}
