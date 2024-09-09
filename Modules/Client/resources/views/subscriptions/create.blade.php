<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">Create Subscription</h1>
        <a href="{{ route('clients.index') }}" class="btn btn-danger float-end">Back</a>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('subscriptions.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Client</label>
                <select name="client_id" id="client_id" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                    <option value="" disabled selected>Select a client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="plan_name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Plan Name</label>
                <input type="text" id="plan_name" name="plan_name" value="{{ old('plan_name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('plan_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="billing_cycle" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Billing Cycle</label>
                <select id="billing_cycle" name="billing_cycle" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                    <option value="" disabled selected>Select a billing cycle</option>
                    <option value="annually" {{ old('billing_cycle') == 'annually' ? 'selected' : '' }}>Annually</option>
                    <option value="2_years" {{ old('billing_cycle') == '2_years' ? 'selected' : '' }}>2 years</option>
                    <option value="3_years" {{ old('billing_cycle') == '3_years' ? 'selected' : '' }}>3 years</option>
                    <option value="4_years" {{ old('billing_cycle') == '4_years'? 'selected' : '' }}>4 years</option>
                    <option value="5_years" {{ old('billing_cycle') == '5_years'? 'selected' : '' }}>5 years</option>
                    <option value="6_years" {{ old('billing_cycle') == '6_years'? 'selected' : '' }}>6 years</option>
                    <option value="7_years" {{ old('billing_cycle') == '7_years'? 'selected' : '' }}>7 years</option>
                    <option value="8_years" {{ old('billing_cycle') == '8_years'? 'selected' : '' }}>8 years</option>
                </select>
                @error('billing_cycle')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('start_date')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Amount</label>
                <input type="number" id="amount" name="amount" value="{{ old('amount') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    step="0.01" readonly required>
                @error('amount')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                <select id="status" name="status" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                    <option value="" disabled selected>Select a status</option>
                    <option value="paid" {{ old('status') == 'paid' ?'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ old('status') == 'unpaid' ?'selected' : '' }}>Unpaid</option>
                </select>
                @error('status')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror  
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('subscriptions.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    Back to Subscription List
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Subscription
                </button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#billing_cycle').on('change', function () {
                let billingCycle = $(this).val();
                
                if (billingCycle) {
                    $.ajax({
                        url: '{{ route("get.amount") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            billing_cycle: billingCycle
                        },
                        success: function (response) {
                            $('#amount').val(response.amount);
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#amount').val('');
                }
            });
        });
    </script>
</x-app-layout>
