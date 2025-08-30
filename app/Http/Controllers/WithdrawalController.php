<?php
namespace App\Http\Controllers;
use App\Models\Store;
use App\Models\Withdrawal;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class WithdrawalController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $userStore = Store::where('id_user', Auth::id())->first();
        if (!$userStore) {
            return redirect('/buattoko')->with('error', 'Anda belum memiliki toko. Silakan buat toko terlebih dahulu.');
        }
        $availableBalance = $this->calculateAvailableBalance($userStore);
        $withdrawalHistory = Withdrawal::where('store_id', $userStore->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('withdrawal.index', compact('userStore', 'availableBalance', 'withdrawalHistory'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:100',
            'bank_account_number' => 'required|string|max:50',
            'bank_account_name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:50000' // Minimum penarikan 50rb
        ]);
        $userStore = Store::where('id_user', Auth::id())->first();
        if (!$userStore) {
            return redirect()->back()->with('error', 'Toko tidak ditemukan.');
        }
        $availableBalance = $this->calculateAvailableBalance($userStore);
        if ($request->amount > $availableBalance) {
            return redirect()->back()->with('error', 'Jumlah penarikan melebihi saldo yang tersedia. Saldo tersedia: Rp ' . number_format($availableBalance, 0, ',', '.'));
        }
        $adminFee = $request->amount * 0.025;
        $netAmount = $request->amount - $adminFee;
        Withdrawal::create([
            'store_id' => $userStore->id,
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'admin_fee' => $adminFee,
            'net_amount' => $netAmount,
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_name' => $request->bank_account_name,
            'status' => 'pending',
            'notes' => $request->notes,
            'requested_at' => now()
        ]);
        return redirect()->back()->with('success', 'Permintaan penarikan berhasil diajukan. Tim admin akan memproses dalam 1-3 hari kerja.');
    }
    private function calculateAvailableBalance($userStore)
    {
        $completedTransactions = Transaksi::whereHas('jasa', function($query) use ($userStore) {
            $query->where('id_store', $userStore->id);
        })
        ->where('payment_status', 'paid')
        ->where('order_status', 'completed')
        ->get();
        $totalEarnings = 0;
        foreach ($completedTransactions as $transaction) {
            if ($transaction->freelancer_earnings > 0) {
                $totalEarnings += $transaction->freelancer_earnings;
            } else {
                $platformFeeAmount = $transaction->total * ($transaction->platform_fee_percent / 100);
                $freelancerEarning = $transaction->total - $platformFeeAmount;
                $totalEarnings += $freelancerEarning;
            }
        }
        $totalWithdrawals = Withdrawal::where('store_id', $userStore->id)
            ->where('status', 'completed')
            ->sum('amount');
        $pendingWithdrawals = Withdrawal::where('store_id', $userStore->id)
            ->where('status', 'pending')
            ->sum('amount');
        return $totalEarnings - $totalWithdrawals - $pendingWithdrawals;
    }
    public function cancel($id)
    {
        $withdrawal = Withdrawal::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();
        if (!$withdrawal) {
            return redirect()->back()->with('error', 'Penarikan tidak ditemukan atau tidak dapat dibatalkan.');
        }
        $withdrawal->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Penarikan berhasil dibatalkan.');
    }
}
