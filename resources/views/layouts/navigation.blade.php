
<!-- Toggle Button -->
<button @click="sidebarOpen = !sidebarOpen" class="nav-toggle">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>

<!-- Side Navigation -->
<nav x-data="{ profileOpen: false }" :class="{'open': sidebarOpen}" class="side-nav">
    <!-- Logo -->
    <div class="logo-container">
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/logo_kasir.png') }}" alt="logo" class="h-9 w-auto" />
        </a>
        @else
        <a href="{{ route('pembelian.index') }}">
            <img src="{{ asset('assets/logo_kasir.png') }}" alt="logo" class="h-9 w-auto" />
        </a>
        @endif
    </div>

    <!-- Navigation Links -->
    @if (Auth::check())
        @php
            $links = [];
            if (Auth::user()->role === 'admin') {
                $links = [
                    ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'user.index', 'label' => 'User', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['route' => 'pelanggan.index', 'label' => 'Pelanggan', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['route' => 'point-settings.index', 'label' => 'Pengaturan Poin', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['route' => 'produk.index', 'label' => 'Produk', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                    ['route' => 'stok.index', 'label' => 'Stok', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                ];
            } elseif (Auth::user()->role === 'petugas') {
                $links = [
                    ['route' => 'produk.index', 'label' => 'Produk', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                    ['route' => 'stok.index', 'label' => 'Stok', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                    ['route' => 'pembelian.index', 'label' => 'Pembelian', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                ];
            }
        @endphp
        <div class="nav-links space-y-1">
            @foreach ($links as $link)
                <x-nav-link :href="route($link['route'])" :active="request()->routeIs($link['route'] . '*')" class="nav-link">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                    </svg>
                    {{ __($link['label']) }}
                </x-nav-link>
            @endforeach
        </div>
    @endif

    <!-- User Profile Section -->
    <div class="user-profile">
        <div class="user-profile-content">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <div class="font-medium">{{ Auth::user()->nama_lengkap }}</div>
                    <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1">
                <x-nav-link :href="route('profile.edit')" class="nav-link">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    {{ __('Profile') }}
                </x-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link :href="route('logout')" class="nav-link"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
