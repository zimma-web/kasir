<x-app-layout>
    <link rel="preload" as="image" href="{{ asset('assets/tango.jpg') }}">
    <style>
        #loading {
            display: none;
        }
        .loading-card {
            width: 400px;
            height: 250px;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .loading-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }
        .loading-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .loading-content {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.75);
            padding: 1.5rem;
            backdrop-filter: blur(4px);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>

    <!-- Loading Overlay -->
    <div id="loading" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="loading-card shadow-xl">
            <div class="loading-bg">
                <img src="{{ asset('assets/tango.jpg') }}" alt="Loading background">
            </div>
            <div class="loading-content">
                <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-500 mx-auto"></div>
                <p class="mt-3 text-center font-medium text-gray-700">Loading...</p>
            </div>
        </div>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pilih Produk') }}
        </h2>
    </x-slot>

    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Top Bar with Search, Sort and Cart -->
            <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <!-- Search Form -->
                <form action="{{ route('pembelian.index') }}" method="GET" class="flex-1">
                    <div class="relative flex items-center">
                        <input type="text" 
                               name="search" 
                               value="{{ $search ?? '' }}"
                               placeholder="Cari produk..." 
                               class="w-full pl-4 pr-12 py-2.5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                        <button type="submit" 
                                class="absolute right-0 h-full px-4 text-gray-500 hover:text-blue-500 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Sort Dropdown -->
                <div class="relative">
                    <button id="sortDropdownButton1" data-dropdown-toggle="dropdownSort1"
                        class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 hover:bg-gray-50 transition-all duration-200 font-medium text-sm">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4" />
                        </svg>
                        Urutkan
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="dropdownSort1"
                        class="z-50 hidden w-48 bg-white rounded-xl shadow-lg dark:bg-gray-700 border border-gray-100 dark:border-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li>
                                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'termurah', 'search' => $search ?? null]) }}"
                                    class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    💰 Termurah
                                </a>
                            </li>
                            <li>
                                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'termahal', 'search' => $search ?? null]) }}"
                                    class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    💎 Termahal
                                </a>
                            </li>
                            <li>
                                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'terbaru', 'search' => $search ?? null]) }}"
                                    class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    🆕 Terbaru
                                </a>
                            </li>
                            <li>
                                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'terlama', 'search' => $search ?? null]) }}"
                                    class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    ⏳ Terlama
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" 
                   class="group bg-green-500 hover:bg-green-600 text-white px-6 py-2.5 rounded-lg transition-all duration-200 flex items-center gap-2 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    KERANJANG
                    <div id="cart-badge"
                        class="bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center group-hover:scale-110 transition-transform">
                        {{ count(session('cart', [])) }}
                    </div>
                </a>
            </div>

            <!-- Product Grid -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @forelse ($produk as $item)
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-700 group w-full max-w-[280px] mx-auto flex flex-col">
                        <div class="h-[200px] flex items-center justify-center p-4 bg-white flex-shrink-0">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" 
                                     alt="{{ $item->nama_produk }}" 
                                     class="max-h-full w-auto object-contain">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 rounded">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 flex flex-col flex-grow justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white leading-tight">{{ $item->nama_produk }}</h3>
                                
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="flex items-center gap-1 {{ $item->stok > 0 ? 'text-green-500' : 'text-red-500' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M20 7l-8 4-8-4m16 0l-8 4-8-4m16 0l-8 4-8-4M4 13.5l8 4 8-4" />
                                        </svg>
                                        {{ $item->stok > 0 ? "Stok: $item->stok" : 'Stok habis' }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between mt-2">
                                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                        Rp.{{ number_format($item->harga, 0, ',', '.') }}
                                    </p>
                                    <button type="button"
                                        onclick="addToCart('{{ $item->id }}', '{{ $item->nama_produk }}', {{ $item->harga }}, {{ $item->stok }})"
                                        class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white w-8 h-8 rounded-full transition-all duration-200 shadow-sm hover:shadow-md {{ $item->stok <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $item->stok <= 0 ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12H4m8-8v16m-8-8l8 8 8-8" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada produk</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="flex justify-center w-full mt-8">
                {!! $produk->appends(['search' => $search ?? null, 'sort_by' => request('sort_by')])->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </section>
</x-app-layout>

<script>
    // Show/hide loading overlay
    $(document).ajaxStart(function() {
        $("#loading").fadeIn(300);
    });

    $(document).ajaxComplete(function() {
        $("#loading").fadeOut(300);
    });

    function addToCart(produk_id, nama_produk, harga, stok) {
        if (stok <= 0) {
            alert('Maaf, stok produk habis!');
            return;
        }

        $.ajax({
            url: '{{ route('cart.add') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                produk_id: produk_id,
                nama_produk: nama_produk,
                harga: harga,
                stok: stok
            },
            success: function(response) {
                if (response && response.message) {
                    // Show success notification
                    const notification = document.createElement('div');
                    notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300';
                    notification.textContent = response.message;
                    document.body.appendChild(notification);

                    // Update cart badge
                    const cartBadge = document.getElementById('cart-badge');
                    if (cartBadge && response.total_items !== undefined) {
                        cartBadge.textContent = response.total_items;
                        cartBadge.classList.add('scale-110');
                        setTimeout(() => cartBadge.classList.remove('scale-110'), 200);
                    }

                    // Remove notification after 3 seconds
                    setTimeout(() => {
                        notification.classList.add('opacity-0');
                        setTimeout(() => notification.remove(), 300);
                    }, 3000);
                }
            },
            error: function(xhr, status, error) {
                // Show error notification
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg';
                notification.textContent = xhr.status === 400 ? xhr.responseJSON.message : 'Terjadi kesalahan saat menambahkan produk ke keranjang!';
                document.body.appendChild(notification);

                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.classList.add('opacity-0');
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        });
    }
</script>

<style>
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .product-item {
        animation: fadeIn 0.3s ease-out;
    }

    /* Transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
</style>
