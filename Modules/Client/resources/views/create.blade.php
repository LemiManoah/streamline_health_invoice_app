<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">Create Client</h1>
        <h1><a href="{{ url('clients') }}" class="btn btn-danger float-end">Back</a></h1>

    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-800">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="facility_level" class="block text-sm font-medium text-gray-700 dark:text-gray-800">Facility Level</label>
                <select id="facility_level" name="facility_level" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                    <option value="" disabled selected>Select a facility level</option>
                    @foreach(['HCI', 'HCII', 'HCIII', 'HCIV', 'Clinic', 'Hospital', 'Referral Hospital'] as $level) <!-- Replace with your enum values -->
                        <option value="{{ $level }}" {{ old('facility_level') == $level ? 'selected' : '' }}>
                            {{ ucfirst($level) }}
                        </option>
                    @endforeach
                </select>
                @error('facility_level')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-800">location</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('location')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="contact_person_name" class="block text-sm font-medium text-gray-700 dark:text-gray-800">contact_person_name</label>
                <input type="text" id="contact_person_name" name="contact_person_name" value="{{ old('contact_person_name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('contact_person_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contact_person_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-800">contact_person_phone</label>
                <input type="tel" id="contact_person_phone" name="contact_person_phone" value="{{ old('contact_person_phone') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('contact_person_phone')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email_for_invoices" class="block text-sm font-medium text-gray-700 dark:text-gray-800">email_for_invoices</label>
                <input type="email" id="email_for_invoices" name="email_for_invoices" value="{{ old('email_for_invoices') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('email_for_invoices')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="billing_cycle" class="block text-sm font-medium text-gray-700 dark:text-gray-800">Billing Cycle</label>
                <input type="number" id="billing_cycle" name="billing_cycle" value="{{ old('billing_cycle') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('billing_cycle')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="streamline_engineer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-800">streamline_engineer_name</label>
                <input type="text" id="streamline_engineer_name" name="streamline_engineer_name" value="{{ old('streamline_engineer_name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('streamline_engineer_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="streamline_engineer_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-800">streamline_engineer_phone</label>
                <input type="tel" id="streamline_engineer_phone" name="streamline_engineer_phone" value="{{ old('streamline_engineer_phone') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('streamline_engineer_phone')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="streamline_engineer_email" class="block text-sm font-medium text-gray-700 dark:text-gray-800">streamline_engineer_email</label>
                <input type="streamline_engineer_email" id="streamline_engineer_email" name="streamline_engineer_email" value="{{ old('streamline_engineer_email') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('streamline_engineer_email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('clients.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    Back to Client List
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Client
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
