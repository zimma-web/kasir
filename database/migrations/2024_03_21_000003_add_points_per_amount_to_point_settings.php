<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('point_settings', function (Blueprint $table) {
            $table->decimal('amount_per_point', 10, 2)->default(10000.00)->after('points_to_rupiah');
            $table->text('earning_description')->nullable()->after('description');
        });

        // Update default setting
        DB::table('point_settings')->update([
            'amount_per_point' => 10000.00,
            'earning_description' => 'Default: Rp 10.000 = 1 poin'
        ]);
    }

    public function down(): void
    {
        Schema::table('point_settings', function (Blueprint $table) {
            $table->dropColumn(['amount_per_point', 'earning_description']);
        });
    }
};
