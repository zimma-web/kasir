<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointSetting extends Model
{
    protected $fillable = [
        'points_to_rupiah',
        'description',
        'amount_per_point',
        'earning_description'
    ];

    protected $casts = [
        'points_to_rupiah' => 'integer',
        'amount_per_point' => 'decimal:2'
    ];

    public static function getConversionRate()
    {
        return static::first()->points_to_rupiah ?? 1;
    }

    public static function getAmountPerPoint()
    {
        return static::first()->amount_per_point ?? 10000.00;
    }

    public static function calculatePointsEarned($amount)
    {
        $amountPerPoint = static::getAmountPerPoint();
        return (int) floor($amount / $amountPerPoint);
    }

    public static function convertPointsToRupiah($points)
    {
        $rate = static::getConversionRate();
        return $points * $rate;
    }

    public static function formatAmountPerPoint()
    {
        $amount = static::getAmountPerPoint();
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
