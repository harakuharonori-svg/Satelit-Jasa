<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Jasa;
use App\Models\Transaksi;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TokoController extends Controller
{
    public function show($id)
    {
        // Cari toko berdasarkan ID - tidak perlu login untuk melihat
        $store = Store::with(['user', 'jasas.jasa_banners'])->findOrFail($id);
        
        // Cek apakah user yang sedang login adalah pemilik toko (jika ada yang login)
        $isOwner = Auth::check() && Auth::id() == $store->id_user;
        
        // Ambil data statistik toko
        $totalServices = Jasa::where('id_store', $store->id)->count();
        
        // Hitung jumlah proyek yang benar-benar selesai (dengan sistem baru)
        $completedProjects = Transaksi::whereHas('jasa', function($query) use ($store) {
            $query->where('id_store', $store->id);
        })
        ->where('payment_status', 'paid') // Only count paid orders
        ->where('order_status', 'completed') // Only count completed projects
        ->count();
        
        // Fallback untuk data lama jika tidak ada proyek dengan sistem baru
        if ($completedProjects == 0) {
            $hasNewStyleOrders = Transaksi::whereHas('jasa', function($query) use ($store) {
                $query->where('id_store', $store->id);
            })
            ->whereNotNull('order_status')
            ->exists();
            
            if (!$hasNewStyleOrders) {
                $completedProjects = Transaksi::whereHas('jasa', function($query) use ($store) {
                    $query->where('id_store', $store->id);
                })->where('status', 'Selesai')->count();
            }
        }
        
        // Hitung total penghasilan dari proyek yang selesai (hanya untuk owner)
        $totalEarnings = 0;
        if ($isOwner) {
            // Pendapatan dari proyek yang benar-benar selesai
            $completedTransactions = Transaksi::whereHas('jasa', function($query) use ($store) {
                $query->where('id_store', $store->id);
            })
            ->where('payment_status', 'paid')
            ->where('order_status', 'completed')
            ->get();
            
            $completedEarnings = 0;
            foreach ($completedTransactions as $transaction) {
                // Jika freelancer_earnings sudah dihitung, gunakan itu
                if ($transaction->freelancer_earnings > 0) {
                    $completedEarnings += $transaction->freelancer_earnings;
                } else {
                    // Temporary: hitung sendiri jika belum ada (90% dari total setelah dikurangi platform fee)
                    $platformFeeAmount = $transaction->total * ($transaction->platform_fee_percent / 100);
                    $freelancerEarning = $transaction->total - $platformFeeAmount;
                    $completedEarnings += $freelancerEarning;
                }
            }
            
            // Total penarikan dana yang sudah berhasil
            $totalWithdrawals = Withdrawal::where('store_id', $store->id)
                ->where('status', 'completed')
                ->sum('amount');
            
            // Total penghasilan = pendapatan dari proyek selesai - penarikan dana
            $totalEarnings = $completedEarnings - $totalWithdrawals;
            
            // Fallback untuk data lama jika tidak ada data dengan sistem baru
            if ($completedEarnings == 0) {
                $hasNewStyleOrders = Transaksi::whereHas('jasa', function($query) use ($store) {
                    $query->where('id_store', $store->id);
                })
                ->whereNotNull('freelancer_earnings')
                ->exists();
                
                if (!$hasNewStyleOrders) {
                    $oldEarnings = Transaksi::whereHas('jasa', function($query) use ($store) {
                        $query->where('id_store', $store->id);
                    })->where('status', 'Selesai')->sum('total');
                    
                    $totalEarnings = $oldEarnings - $totalWithdrawals;
                }
            }
        }
        
        // Hitung tahun pengalaman berdasarkan tanggal pembuatan toko (publik)
        $experienceYears = 0;
        if ($store->created_at) {
            $yearsDiff = Carbon::now()->diffInYears($store->created_at);
            
            if ($yearsDiff >= 1) {
                $experienceYears = $yearsDiff;
            } else {
                $monthsDiff = Carbon::now()->diffInMonths($store->created_at);
                if ($monthsDiff >= 6) {
                    $experienceYears = "< 1";
                } else {
                    $experienceYears = 0;
                }
            }
        }
        
        // Ambil jasa-jasa yang dimiliki toko (publik)
        $jasaList = Jasa::where('id_store', $store->id)
                       ->with('jasa_banners')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('toko', compact(
            'store',
            'isOwner',
            'totalServices',
            'totalEarnings',
            'completedProjects',
            'experienceYears',
            'jasaList'
        ));
    }

    // Method untuk redirect ke toko milik user sendiri
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userStore = Store::where('id_user', Auth::id())->first();
        
        if (!$userStore) {
            return redirect('/buattoko')->with('error', 'Anda belum memiliki toko. Silakan buat toko terlebih dahulu.');
        }

        return redirect()->route('toko.show', $userStore->id);
    }
}
