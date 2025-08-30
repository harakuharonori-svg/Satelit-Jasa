<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jasa_banner extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'id_jasa', 'image'
    ];

    // Relasi dengan Jasa
    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa');
    }
}
