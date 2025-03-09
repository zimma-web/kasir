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
        'user_id'
    ];

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
