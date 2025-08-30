<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'nama', 'deskripsi'
    ];

    // Relasi many-to-many dengan Jasa
    public function jasas()
    {
        return $this->belongsToMany(Jasa::class, 'kategori_jasas', 'id_kategori', 'id_jasa');
    }
}
