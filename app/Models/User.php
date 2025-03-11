<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            // Get last ID
            $lastId = static::orderBy('id', 'desc')->first()?->id;
            
            if (!$lastId) {
                // If no existing records, start with USR1
                $newId = 'USR1';
            } else {
                // Extract number from last ID
                $lastNumber = intval(substr($lastId, 3));
                // Generate new ID
                $newId = 'USR' . ($lastNumber + 1);
            }
            
            $model->id = $newId;
        });
    }

    protected $table = 'users';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
