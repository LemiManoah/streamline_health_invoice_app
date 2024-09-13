<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Subscription') }}
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
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('start_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="billing_cycle_in_years" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Billing Cycle(years)</label>
                        <input type="number" id="billing_cycle_in_years" name="billing_cycle_in_years" value="{{ old('billing_cycle_in_years') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('billing_cycle_in_years')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="next_billing_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Next Billing Date</label>
                        <input type="date" id="next_billing_date" name="next_billing_date" value="{{ old('next_billing_date') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('next_billing_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Amount</label>
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
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
                            <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="unpaid" {{ old('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
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
        </div>
    </div>
</x-app-layout>
