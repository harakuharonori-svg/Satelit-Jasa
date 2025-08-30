<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'delivered_by',
        'delivery_message',
        'delivery_files',
        'delivery_type',
        'status',
        'delivered_at',
        'viewed_at',
        'responded_at',
        'customer_feedback',
        'customer_rating',
        'requires_revision',
        'revision_notes',
        'file_metadata',
        'is_final_delivery',
        'revision_number'
    ];

    protected $casts = [
        'delivery_files' => 'array',
        'file_metadata' => 'array',
        'delivered_at' => 'datetime',
        'viewed_at' => 'datetime',
        'responded_at' => 'datetime',
        'requires_revision' => 'boolean',
        'is_final_delivery' => 'boolean'
    ];

    // Relationships
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function deliveredBy()
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }

    public function customer()
    {
        return $this->transaksi->user;
    }

    // Scopes
    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'delivered');
    }

    // Helper methods
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'delivered';
    }

    public function needsRevision()
    {
        return $this->requires_revision || $this->status === 'revision_requested';
    }
}
