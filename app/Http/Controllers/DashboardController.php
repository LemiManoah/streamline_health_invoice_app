<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
{
    $dashboardData = [
        [
            'count' => 82,
            'label' => 'Total Clients',
            'icon' => 'clients', // reference to the icon
            'color' => 'bg-indigo-600'
        ],
        [
            'count' => 21,
            'label' => 'New Clients',
            'icon' => 'new_clients',
            'color' => 'bg-orange-600'
        ],
        [
            'count' => 42,
            'label' => 'Notifications',
            'icon' => 'notifications',
            'color' => 'bg-pink-600'
        ]
    ];

    return view('dashboard', compact('dashboardData'));
}

}
