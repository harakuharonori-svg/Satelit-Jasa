<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Withdrawal extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'user_id',
        'withdrawal_id',
        'amount',
        'admin_fee',
        'net_amount',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
        'notes',
        'admin_notes',
        'requested_at',
        'processed_at',
        'completed_at',
        'transaction_reference',
        'processed_by',
        'processing_method'
    ];
    protected $casts = [
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
        'amount' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'net_amount' => 'decimal:2'
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
    public function isPending()
    {
        return $this->status === 'pending';
    }
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
    public function isRejected()
    {
        return $this->status === 'rejected';
    }
    public function canCancel()
    {
        return in_array($this->status, ['pending']);
    }
    public function generateWithdrawalId()
    {
        return 'WD-' . time() . '-' . $this->store_id;
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($withdrawal) {
            if (empty($withdrawal->withdrawal_id)) {
                $withdrawal->withdrawal_id = 'WD-' . time() . '-' . $withdrawal->store_id;
            }
            if (empty($withdrawal->requested_at)) {
                $withdrawal->requested_at = now();
            }
        });
    }
}
