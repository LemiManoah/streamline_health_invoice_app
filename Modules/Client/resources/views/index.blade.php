@extends('client::layouts.master')

@section('content')

@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client List') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <!-- Desktop View -->
        <div class="hidden md:block">
            <div class="mb-4 flex justify-between items-center">
                <a href="{{ route('clients.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add New Client
                </a>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Facility Level</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">client Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Contact Person</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Contact Person Phone</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Streamline Engineer</th>
                        <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                    @forelse($clients as $client)
                        <tr>
                            <td class="px-2 py-1 whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-400">{{ $client->id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-800">{{ $client->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-800">{{ $client->facility_level }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-800">{{ $client->client_email}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-800">{{ $client->contact_person_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-800">{{ $client->contact_person_phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-800">{{ $client->streamline_engineer_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('clients.show', $client->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Details</a>
                                <a href="{{ route('clients.edit', $client->id) }}" class="ml-4 text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-4 text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No clients found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile View -->
        {{-- <div class="block md:hidden space-y-4">
            @forelse($users as $user)
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                    </div>
                    <div class="mb-4">
                        @foreach($user->roles as $role)
                            <span class="inline-block px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">View</a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md text-center text-gray-500 dark:text-gray-400">
                    No users found.
                </div>
            @endforelse
        </div> --}}
    </div>
</x-app-layout>
