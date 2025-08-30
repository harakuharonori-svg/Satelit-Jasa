<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable, HasFactory;
    
    protected $guarded = [
        'id', 'created_at', 'update_at'
    ];

    // Relasi dengan Store
    public function store()
    {
        return $this->hasOne(Store::class, 'id_user');
    }

    // Relasi dengan Transaksi (sebagai pembeli)
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_user');
    }
}
