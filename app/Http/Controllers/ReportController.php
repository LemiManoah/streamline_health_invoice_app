<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Invoice\Models\Invoice;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'report_type' => 'required|in:revenue,client,status',
        ]);

        $query = Invoice::whereBetween('created_at', [
            $request->start_date,
            $request->end_date
        ]);

        switch ($request->report_type) {
            case 'revenue':
                $data = $query->select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('sum(total_amount) as total'),
                    DB::raw('count(*) as count')
                )
                    ->groupBy('date')
                    ->get();
                break;

            case 'client':
                $data = $query->with('client')
                    ->select('client_id', DB::raw('sum(total_amount) as total'))
                    ->groupBy('client_id')
                    ->get();
                break;

            case 'status':
                $data = $query->select('status', DB::raw('count(*) as count'))
                    ->groupBy('status')
                    ->get();
                break;
        }

        return response()->json($data);
    }
}