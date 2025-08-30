<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminWithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $query = Withdrawal::with(['store.user', 'user']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            })->orWhere('bank_account_name', 'LIKE', "%{$search}%")
              ->orWhere('bank_account_number', 'LIKE', "%{$search}%");
        }
        if ($request->filled('date_from')) {
            $query->whereDate('requested_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('requested_at', '<=', $request->date_to);
        }
        $withdrawals = $query->orderBy('requested_at', 'desc')->paginate(20);
        $stats = [
            'total_pending' => Withdrawal::where('status', 'pending')->count(),
            'total_completed' => Withdrawal::where('status', 'completed')->count(),
            'total_rejected' => Withdrawal::where('status', 'rejected')->count(),
            'total_processing' => Withdrawal::where('status', 'processing')->count(),
            'total_amount_pending' => Withdrawal::where('status', 'pending')->sum('amount'),
            'total_amount_completed' => Withdrawal::where('status', 'completed')->sum('amount'),
            'total_amount_rejected' => Withdrawal::where('status', 'rejected')->sum('amount'),
        ];
        return view('admin.withdrawals.index', compact('withdrawals', 'stats'));
    }
    public function show($id)
    {
        $withdrawal = Withdrawal::with(['store.user', 'user'])->findOrFail($id);
        $userStore = $withdrawal->store;
        $totalEarnings = $this->calculateTotalEarnings($userStore);
        $completedWithdrawals = Withdrawal::where('store_id', $userStore->id)
            ->where('status', 'completed')
            ->sum('amount');
        $withdrawalHistory = Withdrawal::where('store_id', $userStore->id)
            ->where('id', '!=', $id)
            ->orderBy('requested_at', 'desc')
            ->limit(10)
            ->get();
        return view('admin.withdrawals.show', compact('withdrawal', 'totalEarnings', 'completedWithdrawals', 'withdrawalHistory'));
    }
    public function approve(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Penarikan ini sudah diproses sebelumnya.');
        }
        try {
            $withdrawal->update([
                'status' => 'completed',
                'processed_at' => now(),
                'processed_by' => Auth::id(),
                'admin_notes' => $request->admin_notes
            ]);
            return redirect()->route('admin.withdrawals.show', $id)->with('success', 'Penarikan berhasil disetujui dan diproses.');
        } catch (\Exception $e) {
            \Log::error('Error approving withdrawal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui penarikan. Silakan coba lagi.');
        }
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|min:10|max:500'
        ], [
            'admin_notes.required' => 'Alasan penolakan wajib diisi.',
            'admin_notes.min' => 'Alasan penolakan minimal 10 karakter.',
            'admin_notes.max' => 'Alasan penolakan maksimal 500 karakter.'
        ]);
        $withdrawal = Withdrawal::findOrFail($id);
        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Penarikan ini sudah diproses sebelumnya.');
        }
        try {
            $withdrawal->update([
                'status' => 'rejected',
                'processed_at' => now(),
                'processed_by' => Auth::id(),
                'admin_notes' => $request->admin_notes
            ]);
            return redirect()->route('admin.withdrawals.show', $id)->with('success', 'Penarikan berhasil ditolak. Alasan: ' . $request->admin_notes);
        } catch (\Exception $e) {
            \Log::error('Error rejecting withdrawal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menolak penarikan. Silakan coba lagi.');
        }
    }
    private function calculateTotalEarnings($userStore)
    {
        $completedTransactions = \App\Models\Transaksi::whereHas('jasa', function($query) use ($userStore) {
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
        return $totalEarnings;
    }
    public function export(Request $request)
    {
        $query = Withdrawal::with(['store.user', 'user']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('requested_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('requested_at', '<=', $request->date_to);
        }
        $withdrawals = $query->orderBy('requested_at', 'desc')->get();
        $filename = 'withdrawals_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $callback = function() use ($withdrawals) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'ID',
                'Freelancer Name',
                'Store Name', 
                'Amount',
                'Admin Fee',
                'Net Amount',
                'Bank Name',
                'Account Number',
                'Account Name',
                'Status',
                'Requested At',
                'Processed At',
                'Notes'
            ]);
            foreach ($withdrawals as $withdrawal) {
                fputcsv($file, [
                    $withdrawal->id,
                    $withdrawal->user->nama,
                    $withdrawal->store->nama_store,
                    $withdrawal->amount,
                    $withdrawal->admin_fee,
                    $withdrawal->net_amount,
                    $withdrawal->bank_name,
                    $withdrawal->bank_account_number,
                    $withdrawal->bank_account_name,
                    $withdrawal->status,
                    $withdrawal->requested_at,
                    $withdrawal->processed_at,
                    $withdrawal->admin_notes
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
