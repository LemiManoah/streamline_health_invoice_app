<?php

namespace Modules\Client\Http\Controllers;

use Modules\Client\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'facility_level' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_phone' => 'required|string|max:20',
            'email_for_invoices' => 'required|email|max:255',
            'billing_cycle' => 'required|string|max:255',
            'streamline_engineer_name' => 'required|string|max:255',
            'streamline_engineer_phone' => 'required|string|max:20',
            'streamline_engineer_email' => 'required|email|max:255',
        ]);

        $client = Client::create($request->validated());
        $client->create($request->all());

        return redirect()->route('clients.index')->with('status', 'Client updated successfully!');

    }

    /**
     * Show the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'facility_level' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_phone' => 'required|string|max:20',
            'email_for_invoices' => 'required|email|max:255',
            'billing_cycle' => 'required|string|max:255',
            'streamline_engineer_name' => 'required|string|max:255',
            'streamline_engineer_phone' => 'required|string|max:20',
            'streamline_engineer_email' => 'required|email|max:255',
        ]);

        $client = Client::find($id);
        $client->update($request->all());
        return redirect()->route('clients.index')->with('status','Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('client::index')->with('status','Deleted successfully');
    }
}