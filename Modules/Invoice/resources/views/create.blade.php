<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('invoices.store') }}" method="POST">
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
                        <label for="subscription_id" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Subscription</label>
                        <select name="subscription_id" id="subscription_id" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                            <option value="" disabled selected>Select a Subscription</option>
                            @foreach($subscriptions as $subscription)
                                <option value="{{ $subscription->id }}" {{ old('subscription_id') == $subscription->id ? 'selected' : '' }}>
                                    {{ $subscription->plan_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subscription_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Due Date</label>
                        <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('due_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="total_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Total Amount</label>
                        <input type="number" id="total_amount" name="total_amount" value="{{ old('total_amount') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            step="0.01" required>
                        @error('total_amount')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                        <select id="status" name="status" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                            <option value="" disabled selected>Select a status</option>
                            <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="unpaid" {{ old('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                        @error('status')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('invoices.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            Back to Invoice List
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#subscription_id').on('change', function () {
                let subscriptionId = $(this).val();
                
                if (subscriptionId) {
                    $.ajax({
                        url: '{{ route("get.amount") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            subscription_id: subscriptionId
                        },
                        success: function (response) {
                            $('#total_amount').val(response.amount);
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#total_amount').val('');
                }
            });
        });
    </script>
</x-app-layout>
