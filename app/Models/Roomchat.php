<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roomchat extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'id_user1', 'id_user2'
    ];

    // Relasi dengan User 1 (Customer)
    public function user1()
    {
        return $this->belongsTo(User::class, 'id_user1');
    }

    // Relasi dengan User 2 (Store Owner)
    public function user2()
    {
        return $this->belongsTo(User::class, 'id_user2');
    }

    // Relasi dengan Chat messages
    public function chats()
    {
        return $this->hasMany(Chat::class, 'id_room');
    }

    // Method untuk mendapatkan user lawan chat
    public function getOtherUser($currentUserId)
    {
        return $this->id_user1 == $currentUserId ? $this->user2 : $this->user1;
    }
}
