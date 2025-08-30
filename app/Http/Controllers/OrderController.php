<?php
namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\ClientWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Transaksi::with(['jasa.store.user', 'jasa.banners'])
            ->where('id_user', Auth::id())
            ->where('payment_status', 'paid') // Only show paid orders
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Transaksi::with(['jasa.store.user', 'jasa.banners'])
            ->where('id_user', Auth::id())
            ->where('payment_status', 'paid') // Only show paid orders
            ->findOrFail($id);
        return view('orders.show', compact('order'));
    }
    public function downloadFile($id)
    {
        $order = Transaksi::where('id_user', Auth::id())
            ->where('payment_status', 'paid') // Only allow download for paid orders
            ->findOrFail($id);
        if (!$order->delivery_file || !Storage::exists($order->delivery_file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
        return Storage::download($order->delivery_file);
    }
    public function requestRefund($id)
    {
        $order = Transaksi::where('id_user', Auth::id())
            ->where('payment_status', 'paid') // Only allow refund for paid orders
            ->where('order_status', 'cancelled')
            ->where('refund_status', 'none')
            ->findOrFail($id);
        $order->update([
            'refund_status' => 'pending',
            'refund_amount' => $order->total
        ]);
        return redirect()->back()->with('success', 'Permintaan refund berhasil diajukan. Silakan isi form penarikan dana di halaman profil.');
    }
    public function confirmDelivery($id)
    {
        try {
            $order = Transaksi::where('id_user', Auth::id())
                ->where('payment_status', 'paid')
                ->where('project_status', 'delivered') // Must be delivered first
                ->findOrFail($id);
            $order->update([
                'order_status' => 'completed',
                'project_status' => 'completed',
                'escrow_status' => 'released',
                'completed_at' => now()
            ]);
            return redirect()->back()->with('success', 'Pekerjaan telah dikonfirmasi selesai. Uang telah dilepas ke freelancer.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi pekerjaan: ' . $e->getMessage());
        }
    }
}
