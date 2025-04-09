<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->integer('points')->default(0)->after('jenis_pelanggan');
        });

        Schema::table('penjualan', function (Blueprint $table) {
            $table->integer('points_earned')->default(0)->after('kembalian');
            $table->integer('points_used')->default(0)->after('points_earned');
            $table->decimal('points_discount', 10, 2)->default(0)->after('points_used');
        });
    }

    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->dropColumn('points');
        });

        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn(['points_earned', 'points_used', 'points_discount']);
        });
    }
};
