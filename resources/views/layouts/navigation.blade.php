<nav x-data="{ open: false }" class="bg-slate-700 border-b border-black">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="navbar bg-gray">
            <div class="navbar-start">
                <div class="flex">
                    <!-- Logo -->


                </div>
              <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-circle text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                </label>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                  <li class="text-black">  <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') "  class="text-black">
                    {{ __('Dashboard') }}
                </x-nav-link></li>
                <li>  <x-nav-link :href="route('customers')" :active="request()->routeIs('customers')"  class="text-black">
                    {{ __('Customer') }}
                </x-nav-link></li>
                <li>  <x-nav-link :href="route('products')" :active="request()->routeIs('products')"  class="text-black">
                    {{ __('Product') }}
                </x-nav-link></li>
                <li>
                    <x-nav-link :href="route('sales')" :active="request()->routeIs('sales')"  class="text-black">
                        {{ __('Sales') }}
                    </x-nav-link>
                </li>
                </ul>
              </div>
            </div>
            <div class="navbar-center">
              <a class="btn btn-ghost normal-case text-xl text-white">Laravel Berkat Soft</a>
            </div>
            <div class="navbar-end">
                <div class="dropdown dropdown-end">


                         <!-- Settings Dropdown -->
            <div class="sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-white">
                               Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="btn btn-ghost normal-case text-xl text-white">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
           
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    {{-- <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div> --}}
</nav>
