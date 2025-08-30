<?php
namespace App\Http\Controllers;
use App\Models\ClientWithdrawal;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ClientWithdrawalController extends Controller
{
    public function create($transaksiId)
    {
        $transaksi = Transaksi::where('id_user', Auth::id())
            ->where('refund_status', 'pending')
            ->findOrFail($transaksiId);
        $existingWithdrawal = ClientWithdrawal::where('transaksi_id', $transaksiId)
            ->where('user_id', Auth::id())
            ->first();
        if ($existingWithdrawal) {
            return redirect()->route('profile.index')
                ->with('error', 'Permintaan penarikan dana sudah ada untuk transaksi ini.');
        }
        return view('withdrawals.create', compact('transaksi'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_holder_name' => 'required|string|max:100'
        ]);
        $transaksi = Transaksi::where('id_user', Auth::id())
            ->where('refund_status', 'pending')
            ->findOrFail($request->transaksi_id);
        $existingWithdrawal = ClientWithdrawal::where('transaksi_id', $request->transaksi_id)
            ->where('user_id', Auth::id())
            ->first();
        if ($existingWithdrawal) {
            return redirect()->route('profile.index')
                ->with('error', 'Permintaan penarikan dana sudah ada untuk transaksi ini.');
        }
        $withdrawal = ClientWithdrawal::create([
            'user_id' => Auth::id(),
            'transaksi_id' => $request->transaksi_id,
            'amount' => $transaksi->refund_amount,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_holder_name' => $request->account_holder_name,
            'requested_at' => now()
        ]);
        $withdrawal->markCompleted('Simulasi penarikan dana berhasil diproses');
        return redirect()->route('profile.index')
            ->with('success', 'Permintaan penarikan dana berhasil diproses! Dana akan ditransfer dalam 1-3 hari kerja.');
    }
    public function index()
    {
        $withdrawals = ClientWithdrawal::with('transaksi.jasa')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('withdrawals.index', compact('withdrawals'));
    }
}
