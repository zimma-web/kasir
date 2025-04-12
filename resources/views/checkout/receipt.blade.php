<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran</title>
    <style>
        @page {
            margin: 0;
            /* A5 size */
            size: 148mm 210mm;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            line-height: 1.4;
            width: 148mm;
            margin: 0;
            padding: 20px;
            background: white;
        }
        .store-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .store-logo {
            max-width: 80px;
            margin-bottom: 10px;
        }
        .store-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .store-info {
            font-size: 12px;
            color: #333;
            margin-bottom: 3px;
        }
        .receipt-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 15px 0;
            padding: 8px;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
        }
        .transaction-info {
            margin: 15px 0;
            padding: 10px;
            background-color: #f8f8f8;
            border-radius: 5px;
        }
        .transaction-info div {
            margin-bottom: 5px;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 4px;
        }
        th {
            border-bottom: 2px solid #000;
            font-weight: bold;
        }
        .item-row td {
            padding: 6px 4px;
            border-bottom: 1px solid #eee;
        }
        .total-section {
            margin: 15px 0;
            padding: 10px;
            background-color: #f8f8f8;
            border-radius: 5px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            padding: 3px 0;
        }
        .total-row.grand-total {
            font-weight: bold;
            font-size: 16px;
            border-top: 2px solid #000;
            padding-top: 8px;
            margin-top: 8px;
        }
        .points-info {
            margin: 15px 0;
            padding: 10px;
            background-color: #f0f7ff;
            border-radius: 5px;
        }
        .points-info .title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
        }
        .footer div {
            margin-bottom: 3px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="store-header">
        <img src="{{ asset('assets/logo_kasir.png') }}" alt="Logo" class="store-logo">
        <div class="store-name">Toko Sejahtera</div>
        <div class="store-info">Jl. Raya Serang KM.10</div>
        <div class="store-info">Telp: (021) 123456</div>
        <div class="store-info">Email: info@kasirapp.com</div>
    </div>

    <div class="receipt-title">
        STRUK PEMBAYARAN
    </div>

    <div class="transaction-info">
        <div><strong>No:</strong> {{ $penjualan->id }}</div>
        <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($penjualan->created_at)->format('d/m/Y H:i') }}</div>
        <div><strong>Kasir:</strong> {{ $penjualan->petugas ? $penjualan->petugas->nama_lengkap : 'Unknown' }}</div>
        @if($penjualan->pelanggan)
        <div><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama_pelanggan }}</div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-left">Item</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan->detailPenjualan as $detail)
            <tr class="item-row">
                <td>{{ $detail->nama_produk }}</td>
                <td class="text-center">{{ $detail->jumlah_produk }}</td>
                <td class="text-right">{{ number_format($detail->subtotal / $detail->jumlah_produk, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <span>Total:</span>
            <span>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</span>
        </div>
        @if($penjualan->points_discount > 0)
        <div class="total-row">
            <span>Diskon Poin ({{ $penjualan->points_used }}):</span>
            <span>-Rp {{ number_format($penjualan->points_discount, 0, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>Total Setelah Diskon:</span>
            <span>Rp {{ number_format($penjualan->total_harga - $penjualan->points_discount, 0, ',', '.') }}</span>
        </div>
        @endif
        <div class="total-row">
            <span>Bayar:</span>
            <span>Rp {{ number_format($penjualan->nominal_bayar, 0, ',', '.') }}</span>
        </div>
        <div class="total-row grand-total">
            <span>Kembali:</span>
            <span>Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</span>
        </div>
    </div>

    @if($penjualan->pelanggan && $penjualan->pelanggan->jenis_pelanggan === 'member')
    <div class="points-info">
        <div class="title">Informasi Poin Member:</div>
        @if($penjualan->points_earned > 0)
        <div class="total-row">
            <span>Poin Didapat:</span>
            <span>+{{ $penjualan->points_earned }}</span>
        </div>
        @endif
        @if($penjualan->points_used > 0)
        <div class="total-row">
            <span>Poin Digunakan:</span>
            <span>-{{ $penjualan->points_used }}</span>
        </div>
        @endif
        <div class="total-row">
            <span>Sisa Poin:</span>
            <span>{{ $penjualan->pelanggan->points }}</span>
        </div>
    </div>
    @endif

    <div class="footer">
        <div>Terima kasih atas kunjungan Anda</div>
        <div>Simpan struk ini sebagai bukti pembayaran</div>
        <div>--- {{ config('app.name', 'Kasir App') }} ---</div>
    </div>

    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 500);
        };
    </script>
</body>
</html>
