<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'id_user', 'id_room', 'massage'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan Roomchat
    public function roomchat()
    {
        return $this->belongsTo(Roomchat::class, 'id_room');
    }
}
