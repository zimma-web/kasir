<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaksi Berhasil') }}
        </h2>
    </x-slot>

    <section class="py-12">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
            <div class="text-center mb-8">
                <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h2 class="mt-4 text-2xl font-bold">Transaksi Berhasil!</h2>
                <p class="text-gray-600">ID Transaksi: {{ $penjualan->id }}</p>
            </div>

            <div class="border-t border-b border-gray-200 py-4 mb-4">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Tanggal:</span>
                    <span>{{ \Carbon\Carbon::parse($penjualan->created_at)->format('d/m/Y H:i') }}</span>
                </div>
                @if($penjualan->pelanggan)
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Pelanggan:</span>
                        <span>{{ $penjualan->pelanggan->nama_pelanggan }}</span>
                    </div>
                @endif
                <div class="flex justify-between">
                    <span class="font-semibold">Kasir:</span>
                    <span>{{ $penjualan->petugas ? $penjualan->petugas->nama_lengkap : 'Unknown' }}</span>
                </div>
            </div>

            <table class="w-full mb-6">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">Produk</th>
                        <th class="text-center py-2">Qty</th>
                        <th class="text-right py-2">Harga</th>
                        <th class="text-right py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan->detailPenjualan as $detail)
                        <tr class="border-b">
                            <td class="py-2">{{ $detail->nama_produk }}</td>
                            <td class="text-center py-2">{{ $detail->jumlah_produk }}</td>
                            <td class="text-right py-2">Rp.{{ number_format($detail->subtotal / $detail->jumlah_produk, 2, ',', '.') }}</td>
                            <td class="text-right py-2">Rp.{{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-right">
                    <tr>
                        <td colspan="3" class="text-right font-bold">Total</td>
                        <td class="text-right font-bold">Rp.{{ number_format($penjualan->total_harga, 2, ',', '.') }}</td>
                    </tr>
                    @if($penjualan->points_discount > 0)
                    <tr>
                        <td colspan="3" class="text-right font-bold text-green-600">Diskon Poin ({{ $penjualan->points_used }} poin)</td>
                        <td class="text-right font-bold text-green-600">-Rp.{{ number_format($penjualan->points_discount, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right font-bold">Total Setelah Diskon</td>
                        <td class="text-right font-bold">Rp.{{ number_format($penjualan->total_harga - $penjualan->points_discount, 2, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="3" class="text-right font-bold">Nominal Bayar</td>
                        <td class="text-right font-bold">Rp.{{ number_format($penjualan->nominal_bayar, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right font-bold">Kembalian</td>
                        <td class="text-right font-bold">Rp.{{ number_format($penjualan->kembalian, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

            @if($penjualan->pelanggan && $penjualan->pelanggan->jenis_pelanggan === 'member')
            <div class="border-t border-gray-200 pt-4 mt-4">
                @php
                    $pointSetting = App\Models\PointSetting::first();
                    $conversionRate = $pointSetting ? $pointSetting->points_to_rupiah : 1;
                @endphp
                <h3 class="font-bold mb-2">Informasi Poin Member:</h3>
                <div class="space-y-1 text-sm">
                    @if($penjualan->points_earned > 0)
                        <div class="flex justify-between text-green-600">
                            <span>Poin yang didapat:</span>
                            <span>+{{ $penjualan->points_earned }} (Senilai Rp {{ number_format($penjualan->points_earned * $conversionRate, 0, ',', '.') }})</span>
                        </div>
                    @endif
                    @if($penjualan->points_used > 0)
                        <div class="flex justify-between text-red-600">
                            <span>Poin yang digunakan:</span>
                            <span>-{{ $penjualan->points_used }} (Senilai Rp {{ number_format($penjualan->points_used * $conversionRate, 0, ',', '.') }})</span>
                        </div>
                    @endif
                    <div class="flex justify-between font-semibold">
                        <span>Sisa Poin:</span>
                        <span>{{ $penjualan->pelanggan->points }} (Senilai Rp {{ number_format($penjualan->pelanggan->points * $conversionRate, 0, ',', '.') }})</span>
                    </div>
                </div>
            </div>
            @endif

            <div class="text-center mt-8 space-x-4">
                <a href="{{ route('checkout.print', $penjualan->id) }}" target="_blank"
                    class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Cetak Struk
                </a>
                <a href="{{ route('pembelian.index') }}"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Kembali ke Daftar Transaksi
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
