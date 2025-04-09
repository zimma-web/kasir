<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    /** @use HasFactory<\Database\Factories\PenjualanFactory> */
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->id = \DB::transaction(function () {
                $prefix = 'PNJ';
                $date = now()->format('ymd');
                $lastPenjualan = static::where('id', 'like', $prefix . $date . '%')
                                     ->orderBy('id', 'desc')
                                     ->lockForUpdate()
                                     ->first();
                
                if (!$lastPenjualan) {
                    $newNumber = '001';
                } else {
                    $lastNumber = substr($lastPenjualan->id, -3);
                    $newNumber = str_pad((int)$lastNumber + 1, 3, '0', STR_PAD_LEFT);
                }
                
                return $prefix . $date . $newNumber;
            });
        });
    }

    protected $table = 'penjualan';
    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'tanggal_penjualan',
        'total_harga',
        'nominal_bayar',
        'kembalian',
        'pelanggan_id',
        'user_id',
        'points_earned',
        'points_used',
        'points_discount'
    ];

    /**
     * Calculate final total after points discount
     */
    public function getFinalTotalAttribute(): float
    {
        return $this->total_harga - $this->points_discount;
    }

    /**
     * Process points for the transaction
     */
    public function processPoints(?int $pointsToUse = null): void
    {
        if (!$this->pelanggan_id) {
            return;
        }

        $pelanggan = $this->pelanggan;
        $pointSetting = PointSetting::first();
        $conversionRate = $pointSetting ? $pointSetting->points_to_rupiah : 1;

        // Calculate points earned based on current settings
        $pointsEarned = PointSetting::calculatePointsEarned($this->total_harga);
        $this->points_earned = $pointsEarned;

        // Process points usage if requested
        if ($pointsToUse > 0) {
            try {
                // Calculate discount using conversion rate
                $discount = $pointsToUse * $conversionRate;
                
                if ($pointsToUse > $pelanggan->points) {
                    throw new \Exception('Poin tidak mencukupi');
                }

                if ($discount > $this->total_harga) {
                    throw new \Exception('Nilai diskon melebihi total harga');
                }

                $pelanggan->decrement('points', $pointsToUse);
                $this->points_used = $pointsToUse;
                $this->points_discount = $discount;
                
                // Update total after discount
                $this->total_harga -= $discount;
                $this->kembalian = $this->nominal_bayar - $this->total_harga;
            } catch (\Exception $e) {
                throw new \Exception('Gagal memproses poin: ' . $e->getMessage());
            }
        }

        // Add earned points to customer's balance
        $pelanggan->addPoints($pointsEarned);
        
        $this->save();
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
