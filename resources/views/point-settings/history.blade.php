<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Poin Member') }} - {{ $member->nama_pelanggan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Total Poin Saat Ini: {{ $member->points }}</h3>
                    </div>
                    
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Tanggal</th>
                                    <th scope="col" class="px-6 py-3">ID Transaksi</th>
                                    <th scope="col" class="px-6 py-3">Poin Didapat</th>
                                    <th scope="col" class="px-6 py-3">Poin Digunakan</th>
                                    <th scope="col" class="px-6 py-3">Total Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4">{{ $transaction->id }}</td>
                                    <td class="px-6 py-4 text-green-600">
                                        @if($transaction->points_earned > 0)
                                            +{{ $transaction->points_earned }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-red-600">
                                        @if($transaction->points_used > 0)
                                            -{{ $transaction->points_used }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach

                                @if($transactions->isEmpty())
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="5" class="px-6 py-4 text-center">Tidak ada riwayat transaksi poin</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('point-settings.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
