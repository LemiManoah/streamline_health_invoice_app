<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">Client Details</h1>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-900">Client Information</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Name: <span class="font-medium">{{ $client->name }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Location: <span class="font-medium">{{ $client->location }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Facility Level: <span class="font-medium">{{ $client->facility_level }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Client Email: <span class="font-medium">{{ $client->client_email }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">contact_person_name: <span class="font-medium">{{ $client->contact_person_name }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">contact_person_phone: <span class="font-medium">{{ $client->contact_person_phone }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Billing Cycle: <span class="font-medium">{{ $client->billing_cycle_in_years }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Streamline Engineer Name: <span class="font-medium">{{ $client->streamline_engineer_name }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Streamline Engineer Phone: <span class="font-medium">{{ $client->streamline_engineer_phone }}</span></p>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Streamline Engineer Email: <span class="font-medium">{{ $client->streamline_engineer_email }}</span></p>
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('clients.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                Back to Clients List
            </a>
            <a href="{{ route('clients.edit', $client->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Edit Client
            </a>
        </div>
    </div>
</x-app-layout>
