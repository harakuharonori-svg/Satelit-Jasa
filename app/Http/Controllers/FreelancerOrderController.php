<?php
namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class FreelancerOrderController extends Controller
{
    public function index(Request $request)
    {
        $store = Store::where('id_user', Auth::id())->first();
        if (!$store) {
            return redirect('/buattoko')->with('error', 'Anda belum memiliki toko.');
        }
        $query = Transaksi::with(['jasa', 'user'])
            ->whereHas('jasa', function($query) use ($store) {
                $query->where('id_store', $store->id);
            })
            ->where('payment_status', 'paid'); // Only show paid orders
        $allOrders = Transaksi::whereHas('jasa', function($query) use ($store) {
            $query->where('id_store', $store->id);
        })->where('payment_status', 'paid')->get(); // Only count paid orders
        $stats = [
            'pending' => $allOrders->where('order_status', 'pending')->count(),
            'in_progress' => $allOrders->where('order_status', 'in_progress')->count(),
            'completed' => $allOrders->where('order_status', 'completed')->count(),
            'total_earnings' => $allOrders->where('order_status', 'completed')->sum('total')
        ];
        if ($request->has('status') && !empty($request->status)) {
            $query->where('order_status', $request->status);
        }
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('freelancer.orders.index', compact('orders', 'store', 'stats'));
    }
    public function show($id)
    {
        $store = Store::where('id_user', Auth::id())->first();
        if (!$store) {
            return redirect()->route('dashboard')->with('error', 'Anda belum memiliki toko.');
        }
        $order = Transaksi::with(['jasa', 'user'])
            ->whereHas('jasa', function($query) use ($store) {
                $query->where('id_store', $store->id);
            })
            ->where('payment_status', 'paid') // Only allow access to paid orders
            ->findOrFail($id);
        return view('freelancer.orders.show', compact('order'));
    }
    public function accept(Request $request, $id)
    {
        $store = Store::where('id_user', Auth::id())->first();
        $order = Transaksi::whereHas('jasa', function($query) use ($store) {
            $query->where('id_store', $store->id);
        })
        ->where('order_status', 'pending')
        ->where('payment_status', 'paid') // Only allow paid orders
        ->findOrFail($id);
        $order->update([
            'freelancer_response' => $request->response ?? 'Pesanan diterima dan akan segera dikerjakan.',
            'order_status' => 'in_progress',
            'project_status' => 'in_progress',
            'freelancer_response_at' => now()
        ]);
        return redirect()->back()->with('success', 'Pesanan berhasil diterima!');
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:500'
        ]);
        $store = Store::where('id_user', Auth::id())->first();
        $order = Transaksi::whereHas('jasa', function($query) use ($store) {
            $query->where('id_store', $store->id);
        })
        ->where('order_status', 'pending')
        ->where('payment_status', 'paid') // Only allow paid orders
        ->findOrFail($id);
        $order->update([
            'freelancer_response' => $request->reject_reason,
            'order_status' => 'cancelled',
            'cancellation_reason' => $request->reject_reason,
            'freelancer_response_at' => now(),
            'cancelled_at' => now(),
            'refund_status' => 'pending',
            'refund_amount' => $order->total
        ]);
        return redirect()->back()->with('success', 'Pesanan berhasil ditolak. Refund akan diproses.');
    }
    public function start(Request $request, $id)
    {
        $store = Store::where('id_user', Auth::id())->first();
        $order = Transaksi::whereHas('jasa', function($query) use ($store) {
            $query->where('id_store', $store->id);
        })
        ->where('order_status', 'in_progress')
        ->where('payment_status', 'paid') // Only allow paid orders
        ->findOrFail($id);
        $order->update([
            'freelancer_response' => $request->start_message ?? 'Sedang mengerjakan pesanan Anda.',
            'freelancer_response_at' => now()
        ]);
        return redirect()->back()->with('success', 'Status pesanan telah diperbarui!');
    }
    public function complete(Request $request, $id)
    {
        $request->validate([
            'delivery_file' => 'required|file|mimes:zip,rar,pdf,doc,docx|max:51200', // Max 50MB
            'completion_message' => 'required|string|max:1000'
        ]);
        $store = Store::where('id_user', Auth::id())->first();
        $order = Transaksi::whereHas('jasa', function($query) use ($store) {
            $query->where('id_store', $store->id);
        })
        ->where('order_status', 'in_progress')
        ->where('payment_status', 'paid') // Only allow paid orders
        ->findOrFail($id);
        $filePath = $request->file('delivery_file')->store('deliveries', 'public');
        $platformFeeAmount = $order->total * ($order->platform_fee_percent / 100);
        $freelancerEarning = $order->total - $platformFeeAmount;
        $order->update([
            'delivery_file' => $filePath,
            'freelancer_response' => $request->completion_message,
            'delivered_at' => now(),
            'project_status' => 'delivered', // Set to delivered, wait for client confirmation
            'freelancer_earnings' => $freelancerEarning,
            'platform_fee' => $platformFeeAmount
        ]);
        return redirect()->back()->with('success', 'File berhasil dikirim! Menunggu konfirmasi dari client.');
    }
    public function uploadFile(Request $request, $id)
    {
        $request->validate([
            'delivery_file' => 'required|file|max:10240', // Max 10MB
            'delivery_notes' => 'nullable|string|max:1000'
        ]);
        $store = Store::where('id_user', Auth::id())->first();
        $order = Transaksi::whereHas('jasa', function($query) use ($store) {
            $query->where('id_store', $store->id);
        })
        ->where('order_status', 'in_progress')
        ->findOrFail($id);
        $filePath = $request->file('delivery_file')->store('deliveries', 'public');
        $platformFeeAmount = $order->total * ($order->platform_fee_percent / 100);
        $freelancerEarning = $order->total - $platformFeeAmount;
        $order->update([
            'delivery_file' => $filePath,
            'delivery_notes' => $request->delivery_notes,
            'delivered_at' => now(),
            'project_status' => 'delivered', // Set to delivered, wait for client confirmation
            'freelancer_earnings' => $freelancerEarning,
            'platform_fee' => $platformFeeAmount
        ]);
        return redirect()->back()->with('success', 'File berhasil dikirim! Menunggu konfirmasi dari client.');
    }
}
