<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Support\Str;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Client\Http\Requests\ClientRequest;
use Modules\Client\Emails\ClientVerificationMail;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::paginate(10);
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
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $validated = $request->validated();
    
        $client = new Client();
        $client->fill($validated);
        $client->verification_token = Str::random(40); // Generate a unique token
        $client->save();
    
        // Send verification email
        $verificationUrl = route('clients.custom.verify', ['token' => $client->verification_token]);
        Mail::to($client->client_email)->send(new ClientVerificationMail($client, $verificationUrl));
    
        return redirect()->route('clients.index')->with('success', 'Client created and verification email sent.');
    }
    
    public function show($id)
    {
        // Retrieve the client with the given ID and show its details
        $client = Client::with('subscriptions')->findOrFail($id);
        return view('client::show', compact('client'));
    }

    
    public function edit($id)
    {
        // Retrieve the client with the given ID and show its edit form
        $client = Client::findOrFail($id);
        return view('client::edit', compact('client'));
    }

    
    public function update(ClientRequest $request, $id)
    {
        // Retrieve the client with the given ID and update its details
        $client = Client::findOrFail($id);
        $client->update($request->validated());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }

    
    public function destroy($id)
    {
        // Retrieve the client with the given ID and delete it
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $clients = Client::query()
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('facility_level', 'LIKE', "%{$query}%")
            ->orWhere('streamline_engineer_name', 'LIKE', "%{$query}%")
            ->paginate(10);


        return view('client::index', compact('clients'));
    }
}