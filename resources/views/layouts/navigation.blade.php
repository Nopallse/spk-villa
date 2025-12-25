<nav x-data="{ open: false }" class="bg-white shadow-lg border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <i class="fas fa-home text-2xl text-primary-600"></i>
                        <span class="text-xl font-bold text-gray-800">VillaSleman</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    @if(auth()->user()->role !== 'admin')
                        <x-nav-link href="/preferences" :active="request()->is('preferences')" class="flex items-center">
                            <i class="fas fa-sliders-h mr-2"></i>
                            Cari Villa
                        </x-nav-link>
                        
                        <x-nav-link href="/results" :active="request()->is('results')" class="flex items-center">
                            <i class="fas fa-list mr-2"></i>
                            Rekomendasi
                        </x-nav-link>
                        
                        <x-nav-link href="/history" :active="request()->is('history')" class="flex items-center">
                            <i class="fas fa-history mr-2"></i>
                            Riwayat
                        </x-nav-link>
                    @else
                        <x-nav-link href="/admin/villas" :active="request()->is('admin/villas*')" class="flex items-center">
                            <i class="fas fa-home mr-2"></i>
                            Kelola Villa
                        </x-nav-link>
                        
                        <x-nav-link href="/admin/users" :active="request()->is('admin/users*')" class="flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            Pengguna
                        </x-nav-link>
                        
                        <x-nav-link href="/admin/reports" :active="request()->is('admin/reports*')" class="flex items-center">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Laporan
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if(auth()->user()->role !== 'admin')
                    <!-- Quick Actions for Users -->
                    <div class="flex items-center space-x-3 mr-4">
                        <a href="/preferences" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition text-sm">
                            <i class="fas fa-search mr-2"></i>Cari Villa
                        </a>
                    </div>
                @endif
                
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <div class="bg-primary-100 w-8 h-8 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-user text-primary-600"></i>
                                </div>
                                <div>
                                    <div class="font-semibold">{{ Auth::user()->name }}</div>
                                    @if(auth()->user()->role === 'admin')
                                        <div class="text-xs text-primary-600">Administrator</div>
                                    @else
                                        <div class="text-xs text-gray-500">Pengguna</div>
                                    @endif
                                </div>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                            <i class="fas fa-user-edit mr-2 text-gray-400"></i>
                            {{ __('Edit Profil') }}
                        </x-dropdown-link>
                        
                        @if(auth()->user()->role !== 'admin')
                            <x-dropdown-link href="/favorites" class="flex items-center">
                                <i class="fas fa-heart mr-2 text-red-400"></i>
                                Favorit Saya
                            </x-dropdown-link>
                            
                            <x-dropdown-link href="/history" class="flex items-center">
                                <i class="fas fa-history mr-2 text-blue-400"></i>
                                Riwayat Pencarian
                            </x-dropdown-link>
                        @else
                            <x-dropdown-link href="/admin/settings" class="flex items-center">
                                <i class="fas fa-cog mr-2 text-gray-400"></i>
                                Pengaturan Sistem
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>
                        
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="flex items-center text-red-600 hover:bg-red-50"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center">
                <i class="fas fa-tachometer-alt mr-2"></i>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            @if(auth()->user()->role !== 'admin')
                <x-responsive-nav-link href="/preferences" :active="request()->is('preferences')" class="flex items-center">
                    <i class="fas fa-sliders-h mr-2"></i>
                    Cari Villa
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="/results" :active="request()->is('results')" class="flex items-center">
                    <i class="fas fa-list mr-2"></i>
                    Rekomendasi
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="/history" :active="request()->is('history')" class="flex items-center">
                    <i class="fas fa-history mr-2"></i>
                    Riwayat
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link href="/admin/villas" :active="request()->is('admin/villas*')" class="flex items-center">
                    <i class="fas fa-home mr-2"></i>
                    Kelola Villa
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="/admin/users" :active="request()->is('admin/users*')" class="flex items-center">
                    <i class="fas fa-users mr-2"></i>
                    Pengguna
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="/admin/reports" :active="request()->is('admin/reports*')" class="flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Laporan
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @if(auth()->user()->role === 'admin')
                    <div class="text-xs text-primary-600">Administrator</div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center">
                    <i class="fas fa-user-edit mr-2"></i>
                    {{ __('Edit Profil') }}
                </x-responsive-nav-link>
                
                @if(auth()->user()->role !== 'admin')
                    <x-responsive-nav-link href="/favorites" class="flex items-center">
                        <i class="fas fa-heart mr-2"></i>
                        Favorit Saya
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="flex items-center text-red-600"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
