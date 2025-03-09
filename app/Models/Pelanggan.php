<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggan extends Model
{
    /** @use HasFactory<\Database\Factories\PelangganFactory> */
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            // Get last ID
            $lastId = static::orderBy('id', 'desc')->first()?->id;
            
            if (!$lastId) {
                // If no existing records, start with PLG1
                $newId = 'PLG1';
            } else {
                // Extract number from last ID
                $lastNumber = intval(substr($lastId, 3));
                // Generate new ID
                $newId = 'PLG' . ($lastNumber + 1);
            }
            
            $model->id = $newId;
        });
    }

    protected $table = 'pelanggan';
    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'nomor_telepon',
        'jenis_pelanggan'
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'pelanggan_id');
    }
}
