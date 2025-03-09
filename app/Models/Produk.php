<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory, SoftDeletes;
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            // Get last ID
            $lastId = static::orderBy('id', 'desc')->first()?->id;
            
            if (!$lastId) {
                // If no existing records, start with PDK1
                $newId = 'PDK1';
            } else {
                // Extract number from last ID
                $lastNumber = intval(substr($lastId, 3));
                // Generate new ID
                $newId = 'PDK' . ($lastNumber + 1);
            }
            
            $model->id = $newId;
        });
    }

    protected $table = 'produk';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'gambar'
    ];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'produk_id');
    }
}
