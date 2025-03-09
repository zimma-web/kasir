<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        try {
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            
            DB::beginTransaction();

            // Update Users IDs
            $counter = 1;
            $users = DB::table('users')->get();
            foreach ($users as $user) {
                $oldId = $user->id;
                // Skip if ID is already in the new format
                if (strpos($oldId, 'USR') === 0) {
                    continue;
                }
                
                // Find next available ID
                do {
                    $newId = 'USR' . $counter++;
                } while (DB::table('users')->where('id', $newId)->exists());
                
                DB::table('users')
                    ->where('id', $oldId)
                    ->update(['id' => $newId]);
            }

            // Update Pelanggan IDs
            $counter = 1;
            $pelanggans = DB::table('pelanggan')->get();
            foreach ($pelanggans as $pelanggan) {
                $oldId = $pelanggan->id;
                // Skip if ID is already in the new format
                if (strpos($oldId, 'PLG') === 0) {
                    continue;
                }
                
                // Find next available ID
                do {
                    $newId = 'PLG' . $counter++;
                } while (DB::table('pelanggan')->where('id', $newId)->exists());
                
                DB::table('pelanggan')
                    ->where('id', $oldId)
                    ->update(['id' => $newId]);
            }

            // Update Produk IDs
            $counter = 1;
            $products = DB::table('produk')->get();
            foreach ($products as $product) {
                $oldId = $product->id;
                // Skip if ID is already in the new format
                if (strpos($oldId, 'PDK') === 0) {
                    continue;
                }
                
                // Find next available ID
                do {
                    $newId = 'PDK' . $counter++;
                } while (DB::table('produk')->where('id', $newId)->exists());
                
                DB::table('produk')
                    ->where('id', $oldId)
                    ->update(['id' => $newId]);
            }

            // Update Penjualan IDs
            $counter = 1;
            $penjualans = DB::table('penjualan')->get();
            foreach ($penjualans as $penjualan) {
                $oldId = $penjualan->id;
                // Skip if ID is already in the new format
                if (strpos($oldId, 'PNJ') === 0) {
                    continue;
                }
                
                // Find next available ID
                do {
                    $newId = 'PNJ' . $counter++;
                } while (DB::table('penjualan')->where('id', $newId)->exists());
                
                DB::table('penjualan')
                    ->where('id', $oldId)
                    ->update(['id' => $newId]);
            }

            // Update DetailPenjualan records
            $counter = 1;
            $details = DB::table('detail_penjualan')->get();
            foreach ($details as $detail) {
                $oldId = $detail->id;
                // Skip if ID is already in the new format
                if (strpos($oldId, 'DPNJ') === 0) {
                    continue;
                }
                
                // Find next available ID
                do {
                    $newId = 'DPNJ' . $counter++;
                } while (DB::table('detail_penjualan')->where('id', $newId)->exists());
                
                // Update with new ID format and mapped foreign keys
                DB::table('detail_penjualan')
                    ->where('id', $oldId)
                    ->update([
                        'id' => $newId,
                    ]);
            }

            DB::commit();
            
            // Log success message
            DB::table('migrations')->insert([
                'migration' => '2024_03_19_000002_update_id_formats',
                'batch' => DB::table('migrations')->max('batch') + 1
            ]);

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            
        } catch (\Exception $e) {
            DB::rollBack();
            // Make sure to re-enable foreign key checks even if there's an error
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            throw $e;
        }
    }

    public function down()
    {
        // This migration cannot be reversed as we don't store the original UUIDs
    }
};
