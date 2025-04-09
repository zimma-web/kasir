<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\PointSetting;
use Illuminate\Support\Facades\DB;

class PointSettingController extends Controller
{
    public function index()
    {
        $members = Pelanggan::where('jenis_pelanggan', 'member')
            ->orderBy('nama_pelanggan')
            ->get();
        
        $pointSetting = PointSetting::first();

        return view('point-settings.index', compact('members', 'pointSetting'));
    }

    public function updatePoints(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:0'
        ]);

        $member = Pelanggan::findOrFail($id);
        $member->points = $request->points;
        $member->save();

        return response()->json([
            'success' => true,
            'message' => 'Poin berhasil diperbarui!'
        ]);
    }

    public function resetPoints($id)
    {
        $member = Pelanggan::findOrFail($id);
        $member->points = 0;
        $member->save();

        return response()->json([
            'success' => true,
            'message' => 'Poin berhasil direset!'
        ]);
    }

    public function memberHistory($id)
    {
        $member = Pelanggan::findOrFail($id);
        $transactions = DB::table('penjualan')
            ->where('pelanggan_id', $id)
            ->whereNotNull('points_earned')
            ->orWhereNotNull('points_used')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('point-settings.history', compact('member', 'transactions'));
    }

    public function updateConversionRate(Request $request)
    {
        $request->validate([
            'points_to_rupiah' => 'required|integer|min:1',
            'amount_per_point' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'earning_description' => 'nullable|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            $pointSetting = PointSetting::first();
            if (!$pointSetting) {
                $pointSetting = new PointSetting();
            }

            $pointSetting->points_to_rupiah = $request->points_to_rupiah;
            $pointSetting->amount_per_point = $request->amount_per_point;
            $pointSetting->description = $request->description ?? 'Nilai konversi: 1 poin = Rp ' . $request->points_to_rupiah;
            $pointSetting->earning_description = $request->earning_description ?? 'Rp ' . number_format($request->amount_per_point, 0, ',', '.') . ' = 1 poin';
            $pointSetting->save();

            DB::commit();

            return redirect()->route('point-settings.index')
                ->with('success', 'Pengaturan poin berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('point-settings.index')
                ->with('error', 'Gagal memperbarui pengaturan poin.');
        }
    }

    public function getConversionRate()
    {
        $pointSetting = PointSetting::first();
        return response()->json([
            'points_to_rupiah' => $pointSetting->points_to_rupiah,
            'amount_per_point' => $pointSetting->amount_per_point,
            'description' => $pointSetting->description,
            'earning_description' => $pointSetting->earning_description
        ]);
    }
}
