<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request method'], 400);
        }

        $validated = $request->validate([
            'jenis_pelanggan' => 'required|in:bukan_member,member_baru,member',
            'points_to_use' => 'nullable|integer|min:0',
            'nama_pelanggan' => [
                'nullable',
                'required_if:jenis_pelanggan,member_baru,member',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->jenis_pelanggan === 'member' && !Pelanggan::where('nama_pelanggan', $value)->exists()) {
                        $fail('Nama pelanggan tidak ditemukan.');
                    }
                }
            ],
            'alamat' => 'nullable|required_if:jenis_pelanggan,member_baru|string',
            'nomor_telepon' => [
                'nullable',
                'required_if:jenis_pelanggan,member_baru',
                'string',
                'regex:/^[0-9]{10,13}$/',
                'min:10',
                'max:13'
            ],
            'produk' => 'required|array',
            'produk.*.produk_id' => 'required|exists:produk,id',
            'produk.*.quantity' => 'required|integer|min:1',
            'produk.*.harga' => 'required|numeric|min:0',
            'nominal_bayar' => 'required|numeric|min:0'
        ], [
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'nomor_telepon.min' => 'Nomor telepon minimal 10 digit.',
            'nomor_telepon.max' => 'Nomor telepon maksimal 13 digit.'
        ]);

        $totalHarga = collect($validated['produk'])->sum(fn($item) => $item['harga'] * $item['quantity']);

        // Validate payment amount
        if (!is_numeric($validated['nominal_bayar']) || $validated['nominal_bayar'] <= 0) {
            \Log::error('Invalid payment amount');
            return response()->json([
                'errors' => ['error' => ['Nominal pembayaran tidak valid!']]
            ], 422);
        }

        $nominalBayar = $validated['nominal_bayar'];
        $kembalian = $nominalBayar - $totalHarga;

        // Validate change calculation
        if ($kembalian < 0) {
            \Log::error('Insufficient payment amount');
            return response()->json([
                'errors' => ['error' => ['Jumlah yang dibayarkan kurang dari total harga!']]
            ], 422);
        }

        $pelangganId = null;

        \Log::info('Starting checkout process');
        \Log::info('Validated data:', $validated);
        
        // Validate user authentication
        if (!auth()->check()) {
            \Log::error('User not authenticated');
            return response()->json([
                'errors' => ['error' => ['Anda harus login untuk melakukan transaksi!']]
            ], 401);
        }

        DB::beginTransaction();
        try {
            \Log::info('Beginning transaction');
            if ($validated['jenis_pelanggan'] === 'member_baru') {
                $pelanggan = Pelanggan::create([
                    'nama_pelanggan' => $validated['nama_pelanggan'],
                    'alamat' => $validated['alamat'],
                    'nomor_telepon' => $validated['nomor_telepon'],
                    'jenis_pelanggan' => 'member_baru',
                ]);
                $pelangganId = $pelanggan->id;
            } elseif ($validated['jenis_pelanggan'] === 'member') {
                $pelanggan = Pelanggan::where('nama_pelanggan', $validated['nama_pelanggan'])->first();
                if (!$pelanggan) {
                    return response()->json([
                        'errors' => ['nama_pelanggan' => ['Nama pelanggan tidak ditemukan!']]
                    ], 422);
                }

                $pelanggan->update([
                    'jenis_pelanggan' => 'member',
                ]);

                $pelangganId = $pelanggan->id;
            }

            \Log::info('Creating Penjualan record with data:', [
                'total_harga' => $totalHarga,
                'nominal_bayar' => $nominalBayar,
                'kembalian' => $kembalian,
                'user_id' => auth()->user()->id,
                'pelanggan_id' => $pelangganId
            ]);

            // Check if points are being used
            $pointsToUse = $validated['points_to_use'] ?? 0;
            $pointsDiscount = 0;

            if ($pointsToUse > 0 && $pelangganId) {
                $pelanggan = Pelanggan::find($pelangganId);
                if (!$pelanggan) {
                    return response()->json([
                        'errors' => ['error' => ['Pelanggan tidak ditemukan!']]
                    ], 422);
                }

                if ($pointsToUse > $pelanggan->points) {
                    return response()->json([
                        'errors' => ['error' => ['Poin yang digunakan melebihi poin yang tersedia!']]
                    ], 422);
                }

                // Get current points conversion rate
                $pointSetting = \App\Models\PointSetting::first();
                $conversionRate = $pointSetting ? $pointSetting->points_to_rupiah : 1;
                
                // Calculate points discount using conversion rate
                $pointsDiscount = $pointsToUse * $conversionRate;
                
                // Adjust total and change amount
                $totalHarga = $totalHarga - $pointsDiscount;
                $kembalian = $nominalBayar - $totalHarga;

                if ($kembalian < 0) {
                    return response()->json([
                        'errors' => ['error' => ['Jumlah yang dibayarkan kurang dari total harga setelah diskon poin!']]
                    ], 422);
                }
            }

            try {
                $penjualan = Penjualan::create([
                    'tanggal_penjualan' => Carbon::now(),
                    'total_harga' => $totalHarga + $pointsDiscount, // Store original total before points discount
                    'nominal_bayar' => $nominalBayar,
                    'kembalian' => $kembalian,
                    'user_id' => auth()->user()->id,
                    'pelanggan_id' => $pelangganId,
                    'points_used' => $pointsToUse,
                    'points_discount' => $pointsDiscount,
                ]);

                // Process points after successful creation
                if ($pelangganId) {
                    $penjualan->processPoints($pointsToUse);
                }

                \Log::info('Penjualan created successfully with ID: ' . $penjualan->id);
            } catch (\Exception $e) {
                \Log::error('Failed to create Penjualan record: ' . $e->getMessage());
                throw $e;
            }

            \Log::info('Processing product details for penjualan ID: ' . $penjualan->id);
            
            foreach ($validated['produk'] as $index => $produk) {
                \Log::info('Processing product ' . ($index + 1) . ' of ' . count($validated['produk']));
                
                try {
                    $produkModel = Produk::find($produk['produk_id']);
                    \Log::info('Found product:', ['id' => $produkModel->id, 'name' => $produkModel->nama_produk, 'current_stock' => $produkModel->stok]);

                    if ($produkModel->stok < $produk['quantity']) {
                        \Log::warning('Insufficient stock for product', [
                            'product_id' => $produkModel->id,
                            'requested_quantity' => $produk['quantity'],
                            'available_stock' => $produkModel->stok
                        ]);
                        DB::rollBack();
                        return response()->json([
                            'errors' => ['error' => ['Stok produk ' . $produkModel->nama_produk . ' tidak mencukupi!']]
                        ], 422);
                    }

                    DetailPenjualan::create([
                        'penjualan_id' => $penjualan->id,
                        'produk_id' => $produk['produk_id'],
                        'nama_produk' => $produkModel->nama_produk,
                        'jumlah_produk' => $produk['quantity'],
                        'subtotal' => $produk['quantity'] * $produk['harga']
                    ]);

                    $produkModel->decrement('stok', $produk['quantity']);
                    \Log::info('Stock updated for product: ' . $produkModel->nama_produk);
                } catch (\Exception $e) {
                    \Log::error('Failed to process product: ' . $e->getMessage());
                    throw $e;
                }
            }

            DB::commit();
            \Log::info('Transaction committed successfully');
            \Log::info('Penjualan ID: ' . $penjualan->id);

            session()->forget('cart');

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'redirect' => route('checkout.success', ['id' => $penjualan->id])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Checkout Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('Previous exception: ' . ($e->getPrevious() ? $e->getPrevious()->getMessage() : 'None'));
            
            $errorMessage = config('app.debug') 
                ? $e->getMessage() 
                : 'Terjadi kesalahan saat memproses transaksi!';
            
            return response()->json([
                'errors' => ['error' => [$errorMessage]]
            ], 500);
        }
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'detailPenjualan.produk', 'petugas'])->findOrFail($id);
        return view('checkout.success', compact('penjualan'));
    }

    public function cekMember(Request $request)
    {
        try {
            $namaPelanggan = $request->query('nama_pelanggan');

            if (!$namaPelanggan) {
                return response()->json(['error' => 'Nama pelanggan diperlukan'], 400);
            }

            $members = Pelanggan::where('nama_pelanggan', 'LIKE', "%{$namaPelanggan}%")
                ->select('id', 'nama_pelanggan as nama', 'alamat', 'nomor_telepon', 'points')
                ->get();

            if ($members->isEmpty()) {
                return response()->json([], 200);
            }

            return response()->json($members);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }
}
