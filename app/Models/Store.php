<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Store extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
    protected $fillable = [
        'nama', 
        'deskripsi', 
        'foto_ktp', 
        'id_user',
        'total_earnings',
        'available_balance',
        'pending_balance',
        'withdrawn_amount',
        'minimum_withdrawal',
        'auto_withdrawal_enabled',
        'auto_withdrawal_threshold',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'completed_orders',
        'average_rating',
        'total_reviews'
    ];
    protected $casts = [
        'total_earnings' => 'decimal:2',
        'available_balance' => 'decimal:2',
        'pending_balance' => 'decimal:2',
        'withdrawn_amount' => 'decimal:2',
        'minimum_withdrawal' => 'decimal:2',
        'auto_withdrawal_enabled' => 'boolean',
        'average_rating' => 'decimal:2'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function jasas()
    {
        return $this->hasMany(Jasa::class, 'id_store');
    }
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }
    public function transaksis()
    {
        return $this->hasManyThrough(Transaksi::class, Jasa::class, 'id_store', 'id_jasa');
    }
    public function completedTransaksis()
    {
        return $this->transaksis()->where('project_status', 'completed');
    }
    public function pendingTransaksis()
    {
        return $this->transaksis()->where('escrow_status', 'held')->where('payment_status', 'paid');
    }
    public function canWithdraw($amount)
    {
        return $this->available_balance >= $amount && 
               $amount >= $this->minimum_withdrawal;
    }
    public function getTotalPendingEarnings()
    {
        return $this->pendingTransaksis()->sum('freelancer_earnings');
    }
    public function updatePendingBalance()
    {
        $pendingEarnings = $this->getTotalPendingEarnings();
        $this->update(['pending_balance' => $pendingEarnings]);
        return $pendingEarnings;
    }
    public function hasBankAccount()
    {
        return !empty($this->bank_name) && 
               !empty($this->bank_account_number) && 
               !empty($this->bank_account_name);
    }
    public function updateRating($newRating)
    {
        $totalReviews = $this->total_reviews;
        $currentRating = $this->average_rating;
        $newTotalReviews = $totalReviews + 1;
        $newAverageRating = (($currentRating * $totalReviews) + $newRating) / $newTotalReviews;
        $this->update([
            'average_rating' => round($newAverageRating, 2),
            'total_reviews' => $newTotalReviews
        ]);
        return $newAverageRating;
    }
    public function getPerformanceMetrics()
    {
        return [
            'total_earnings' => $this->total_earnings,
            'available_balance' => $this->available_balance,
            'pending_balance' => $this->pending_balance,
            'completed_orders' => $this->completed_orders,
            'average_rating' => $this->average_rating,
            'total_reviews' => $this->total_reviews,
            'pending_earnings' => $this->getTotalPendingEarnings()
        ];
    }
}
