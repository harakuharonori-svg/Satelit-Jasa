<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ClientWithdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'transaksi_id',
        'amount',
        'bank_name',
        'account_number',
        'account_holder_name',
        'status',
        'notes',
        'requested_at',
        'processed_at'
    ];
    protected $casts = [
        'requested_at' => 'datetime',
        'processed_at' => 'datetime'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
    public function markCompleted($notes = null)
    {
        $this->update([
            'status' => 'completed',
            'notes' => $notes,
            'processed_at' => now()
        ]);
        $this->transaksi->update([
            'refund_status' => 'completed',
            'refunded_at' => now()
        ]);
    }
}
