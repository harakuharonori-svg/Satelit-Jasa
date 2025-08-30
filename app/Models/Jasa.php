<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'id_store', 'judul', 'deskripsi', 'harga'
    ];

    // Relasi dengan Store
    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }

    // Relasi dengan User (melalui Store) - Freelancer yang punya jasa
    public function user()
    {
        return $this->hasOneThrough(User::class, Store::class, 'id', 'id', 'id_store', 'id_user');
    }

    // Atau bisa menggunakan accessor untuk mendapatkan user
    public function getFreelancerAttribute()
    {
        return $this->store?->user;
    }

    // Relasi dengan Jasa Banner
    public function jasa_banners()
    {
        return $this->hasMany(Jasa_banner::class, 'id_jasa');
    }

    // Relasi dengan Transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_jasa');
    }

    // Relasi many-to-many dengan Kategori
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_jasas', 'id_jasa', 'id_kategori');
    }

    // Alias untuk relasi kategori (singular untuk convenience)
    public function kategori()
    {
        return $this->kategoris();
    }

    // Relasi dengan Jasa Banner (alias)
    public function banners()
    {
        return $this->jasa_banners();
    }
}
