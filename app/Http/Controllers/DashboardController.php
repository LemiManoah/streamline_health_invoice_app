<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use Illuminate\Support\Facades\DB;
use Modules\Invoice\Models\Invoice;
use Modules\Client\Models\Subscription;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Clients
        $totalClients = Client::count();


        // Total Revenue 
        $totalRevenue = Subscription::sum('amount');

        // Recent Clients
        $recentClients = Client::latest()->take(5)->get();

        // Recent Invoices
        $recentInvoices = Invoice::with('client')->latest()->take(5)->get();

        // Clients by Verification Status
        $clientsByVerificationStatus = Client::groupBy('verification_status')
            ->select('verification_status', DB::raw('count(*) as total'))
            ->get();

        return view('dashboard', compact(
            'totalClients',
            'totalRevenue',
            'recentClients',
            'recentInvoices',
            'clientsByVerificationStatus'
        ));
    }
}