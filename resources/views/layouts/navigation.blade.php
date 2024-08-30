<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3 bg-white border-r border-gray-100"
>
    <!-- Logo -->
    <div class="flex items-center py-4">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </div>

    <!-- Navigation Links -->
    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Users"
        href="{{ route('users.index') }}"
        :isActive="request()->routeIs('users.*')"
    >
        <x-slot name="icon">
            <i class="fas fa-users flex-shrink-0 w-6 h-6" aria-hidden="true"></i> <!-- Using Font Awesome -->
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Roles"
        href="{{ route('roles.index') }}"
        :isActive="request()->routeIs('roles.*')"
    >
        <x-slot name="icon">
            <i class="fas fa-user-tag flex-shrink-0 w-6 h-6" aria-hidden="true"></i> <!-- Using Font Awesome -->
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Client List"
        href="{{ route('clients.index') }}"
        :isActive="request()->routeIs('clients.*')"
    >
        <x-slot name="icon">
            <i class="fas fa-address-book flex-shrink-0 w-6 h-6" aria-hidden="true"></i> <!-- Using Font Awesome -->
        </x-slot>
    </x-sidebar.link>

    <!-- Settings Dropdown -->
    <x-dropdown align="left" width="48">
        <x-slot name="trigger">
            <button class="flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>

                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</x-perfect-scrollbar>
