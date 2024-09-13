<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Client') }}
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

                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Client Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div> 

                    <div class="mb-4">
                        <label for="facility_level" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Facility Level</label>
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
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('location')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="client_email" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Client Email</label>
                        <input type="email" id="client_email" name="client_email" value="{{ old('client_email') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('client_email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="contact_person_name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Contact Person</label>
                        <input type="text" id="contact_person_name" name="contact_person_name" value="{{ old('contact_person_name') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('contact_person_name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="contact_person_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Contact Person Phone</label>
                        <input type="text" id="contact_person_phone" name="contact_person_phone" value="{{ old('contact_person_phone') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('contact_person_phone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="streamline_engineer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Streamline Engineer Name</label>
                        <input type="text" id="streamline_engineer_name" name="streamline_engineer_name" value="{{ old('streamline_engineer_name') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('streamline_engineer_name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="streamline_engineer_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Streamline Engineer Phone</label>
                        <input type="text" id="streamline_engineer_phone" name="streamline_engineer_phone" value="{{ old('streamline_engineer_phone') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('streamline_engineer_phone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="streamline_engineer_email" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Streamline Engineer Email</label>
                        <input type="email" id="streamline_engineer_email" name="streamline_engineer_email" value="{{ old('streamline_engineer_email') }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                            required>
                        @error('streamline_engineer_email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="flex items-center justify-between">
                        <a href="{{ route('clients.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            Back to Clients List
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
