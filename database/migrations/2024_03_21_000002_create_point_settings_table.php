<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('point_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('points_to_rupiah')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default setting
        DB::table('point_settings')->insert([
            'points_to_rupiah' => 1,
            'description' => 'Default conversion rate: 1 point = Rp 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('point_settings');
    }
};
