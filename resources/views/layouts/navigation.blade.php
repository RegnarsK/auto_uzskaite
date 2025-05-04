<aside class="w-64 min-h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 fixed flex flex-col justify-between">
    <!-- Top Section: Logo + Nav -->
    <div>
        <!-- Logo -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 text-center">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="mx-auto h-10 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-2">
            
           
            @auth
                @if (Auth::user()->usertype === 'admin')
                    <x-nav-link :href="route('admin/cars')" :active="request()->routeIs('admin.cars.*')">
                        {{ __('Manage Cars') }}
                    </x-nav-link>

                @endif
            @endauth

            @auth
                @if (Auth::user()->usertype === 'user')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('All Cars') }}
                </x-nav-link>

                    <x-nav-link :href="route('my/jobs')" :active="request()->routeIs('my/jobs')">
                    {{ __('My Jobs') }}
                </x-nav-link>
                @endif
            @endauth
        </nav>
        
    </div>

    <!-- Bottom Section: User Dropdown -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 ">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600">
                    <div>{{ Auth::user()->name }}</div>
                    <svg class="w-4 h-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414l-4.707-4.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content" >
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</aside>
