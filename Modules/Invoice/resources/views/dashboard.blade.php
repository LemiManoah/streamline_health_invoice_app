<!-- resources/views/dashboard.blade.php -->
@extends('invoice::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Invoices</h3>
        <p class="card-description">Manage your invoices and view their details.</p>
    </div>
    <div class="card-content">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="cursor-pointer">Invoice</th>
                    <th class="cursor-pointer">Customer</th>
                    <th class="cursor-pointer">Due Date</th>
                    <th class="cursor-pointer text-right">Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example data loop -->
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice['id'] }}</td>
                    <td>{{ $invoice['customer'] }}</td>
                    <td>{{ $invoice['dueDate'] }}</td>
                    <td class="text-right">{{ number_format($invoice['total'], 2) }}</td>
                    <td>
                        <span class="badge {{ strtolower($invoice['status']) }}">{{ $invoice['status'] }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
