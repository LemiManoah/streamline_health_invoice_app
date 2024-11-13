<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-700">Client Details</h1>
    </x-slot>
    <br>
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <!-- Client Information -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">Client Information</h2>
                <a href="{{ route('subscriptions.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold shadow-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Subscription
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Name: <span
                            class="font-medium">{{ $client->name }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Location: <span
                            class="font-medium">{{ $client->location }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Facility Level: <span
                            class="font-medium">{{ $client->facility_level }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Client Email: <span
                            class="font-medium">{{ $client->client_email }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Contact Person: <span
                            class="font-medium">{{ $client->contact_person_name }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Contact Person Phone: <span
                            class="font-medium">{{ $client->contact_person_phone }}</span></p>

                </div>
                <div>
                    <!-- Engineer Information -->
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Streamline Engineer Information
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Name: <span
                            class="font-medium">{{ $client->streamline_engineer_name }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Phone: <span
                            class="font-medium">{{ $client->streamline_engineer_phone }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Email: <span
                            class="font-medium">{{ $client->streamline_engineer_email }}</span></p>

                </div>
            </div>
        </div>

        {{-- Subscription information --}}
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Subscription Information</h3>
        @if ($client->subscriptions?->count())
        @foreach ($client->subscriptions as $subscription)
            <div class="mt-2 p-4 border-b border-gray-300 dark:border-gray-600">
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Billing Cycle in years: <span
                        class="font-medium">{{ $subscription->billing_cycle_in_years }}</span></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Plan: <span
                        class="font-medium">{{ $subscription->plan_name }}</span></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Status: <span
                        class="font-medium">{{ $subscription->status }}</span></p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Next Billing Date: <span
                        class="font-medium">{{ $subscription->next_billing_date }}</span></p>
            </div>
        @endforeach
        @else
            <p class="text-sm text-red-600 dark:text-red-400 mt-2">No subscriptions found for this client.</p>
        @endif
    

        

        <!-- Buttons Section -->
        <div class="flex items-center justify-between mt-8">
            <a href="{{ route('clients.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md shadow-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                Back to Clients List
            </a>
            <a href="{{ route('clients.edit', $client->id) }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md shadow-md hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12h4.5m-7.5 4h7.5m-7.5-8h7.5m-7.5-4h7.5M4.5 20.5l1-1.5 3 3 1-1.5m-4-12l-1-1.5m9 13.5v-10m-3 10v-6">
                    </path>
                </svg>
                Edit Client Information
            </a>
        </div>
    </div>
</x-app-layout>
