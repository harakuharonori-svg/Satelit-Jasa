<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Transaksi extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
    protected $fillable = [
        'id_user',
        'id_jasa', 
        'total',
        'status',
        'deadline',
        'selesai',
        'payment_method',
        'payment_reference',
        'payment_status',
        'payment_data',
        'paid_at',
        'external_id',
        'order_status',
        'freelancer_response',
        'freelancer_notes',
        'freelancer_response_at',
        'delivery_file',
        'delivery_notes',
        'delivered_at',
        'cancellation_reason',
        'cancelled_at',
        'refund_status',
        'refund_amount',
        'refunded_at',
        'project_status',
        'escrow_status',
        'completed_at',
        'approved_at',
        'released_at',
        'platform_fee',
        'platform_fee_percent',
        'freelancer_earnings'
    ];
    protected $casts = [
        'deadline' => 'datetime',
        'selesai' => 'datetime',
        'paid_at' => 'datetime',
        'freelancer_response_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'refunded_at' => 'datetime',
        'completed_at' => 'datetime',
        'approved_at' => 'datetime',
        'released_at' => 'datetime',
        'payment_data' => 'array'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa');
    }
    public function deliveries()
    {
        return $this->hasMany(ProjectDelivery::class);
    }
    public function latestDelivery()
    {
        return $this->hasOne(ProjectDelivery::class)->latest();
    }
    public function freelancer()
    {
        return $this->jasa->store->user ?? null;
    }
    public function store()
    {
        return $this->jasa->store ?? null;
    }
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }
    public function isExpired()
    {
        return $this->expired_at && now() > $this->expired_at;
    }
    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }
    public function calculateEarnings()
    {
        $platformFeePercent = $this->platform_fee_percent ?? 10.00;
        $platformFee = ($this->total * $platformFeePercent) / 100;
        $freelancerEarnings = $this->total - $platformFee;
        return [
            'total' => $this->total,
            'platform_fee' => $platformFee,
            'freelancer_earnings' => $freelancerEarnings,
            'platform_fee_percent' => $platformFeePercent
        ];
    }
    public function updateEarnings()
    {
        $earnings = $this->calculateEarnings();
        $this->update([
            'platform_fee' => $earnings['platform_fee'],
            'freelancer_earnings' => $earnings['freelancer_earnings']
        ]);
        return $earnings;
    }
    public function canBeDelivered()
    {
        return $this->isPaid() && 
               $this->escrow_status === 'held' && 
               in_array($this->project_status, ['pending', 'in_progress']);
    }
    public function canBeApproved()
    {
        return $this->project_status === 'delivered';
    }
    public function isEscrowHeld()
    {
        return $this->escrow_status === 'held';
    }
    public function isEscrowReleased()
    {
        return $this->escrow_status === 'released';
    }
    public function shouldAutoRelease()
    {
        if (!$this->delivered_at || $this->isEscrowReleased()) {
            return false;
        }
        $autoReleaseDays = $this->auto_release_days ?? 7;
        $autoReleaseDate = $this->delivered_at->addDays($autoReleaseDays);
        return now() >= $autoReleaseDate;
    }
    public function releaseEscrow($approvedBy = null, $notes = null)
    {
        if (!$this->isEscrowHeld()) {
            return false;
        }
        $this->update([
            'escrow_status' => 'released',
            'project_status' => 'completed',
            'approved_at' => now(),
            'released_at' => now(),
            'approval_notes' => $notes
        ]);
        if ($store = $this->store()) {
            $earnings = (float) $this->freelancer_earnings;
            $store->increment('total_earnings', $earnings);
            $store->increment('available_balance', $earnings);
            $store->increment('completed_orders');
        }
        return true;
    }
    public function scopeEscrowHeld($query)
    {
        return $query->where('escrow_status', 'held');
    }
    public function scopeEscrowReleased($query)
    {
        return $query->where('escrow_status', 'released');
    }
    public function scopeDelivered($query)
    {
        return $query->where('project_status', 'delivered');
    }
    public function scopeCompleted($query)
    {
        return $query->where('project_status', 'completed');
    }
}
