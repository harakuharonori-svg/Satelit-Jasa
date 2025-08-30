<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Jasa;
use App\Models\Transaksi;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfilPageController extends Controller
{
    public function index() {
        $user = Auth::user();
        $hasStore = false;
        $userStore = null;
        $totalServices = 0;
        $totalEarnings = 0;
        $completedProjects = 0;
        $joinDate = null;
        $experienceYears = 0;
        
        if ($user) {
            // Cek apakah user memiliki toko
            $hasStore = Store::where('id_user', $user->id)->exists();
            
            if ($hasStore) {
                $userStore = Store::where('id_user', $user->id)->first();
                
                // Hitung total jasa yang dimiliki user
                $totalServices = Jasa::where('id_store', $userStore->id)->count();
                
                // Hitung jumlah proyek yang benar-benar selesai (dengan sistem baru)
                $completedProjects = Transaksi::whereHas('jasa', function($query) use ($userStore) {
                    $query->where('id_store', $userStore->id);
                })
                ->where('payment_status', 'paid') // Only count paid orders
                ->where('order_status', 'completed') // Only count completed projects
                ->count();
                
                // Fallback untuk data lama jika tidak ada proyek dengan sistem baru
                if ($completedProjects == 0) {
                    $hasNewStyleOrders = Transaksi::whereHas('jasa', function($query) use ($userStore) {
                        $query->where('id_store', $userStore->id);
                    })
                    ->whereNotNull('order_status')
                    ->exists();
                    
                    if (!$hasNewStyleOrders) {
                        $completedProjects = Transaksi::whereHas('jasa', function($query) use ($userStore) {
                            $query->where('id_store', $userStore->id);
                        })->where('status', 'Selesai')->count();
                    }
                }
                
                // Hitung total penghasilan dari proyek yang selesai
                $completedTransactions = Transaksi::whereHas('jasa', function($query) use ($userStore) {
                    $query->where('id_store', $userStore->id);
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
                $totalWithdrawals = Withdrawal::where('store_id', $userStore->id)
                    ->where('status', 'completed')
                    ->sum('amount');
                
                // Total penghasilan = pendapatan dari proyek selesai - penarikan dana
                $totalEarnings = $completedEarnings - $totalWithdrawals;
                
                // Fallback untuk data lama jika tidak ada data dengan sistem baru
                if ($completedEarnings == 0) {
                    $hasNewStyleOrders = Transaksi::whereHas('jasa', function($query) use ($userStore) {
                        $query->where('id_store', $userStore->id);
                    })
                    ->whereNotNull('freelancer_earnings')
                    ->exists();
                    
                    if (!$hasNewStyleOrders) {
                        $oldEarnings = Transaksi::whereHas('jasa', function($query) use ($userStore) {
                            $query->where('id_store', $userStore->id);
                        })->where('status', 'Selesai')->sum('total');
                        
                        $totalEarnings = $oldEarnings - $totalWithdrawals;
                    }
                }
            }
            
            // Hitung tahun pengalaman berdasarkan tanggal join - FIXED VERSION
            $joinDate = $user->created_at;
            $experienceYears = 0; // Default value
            
            if ($joinDate) {
                $yearsDiff = Carbon::now()->diffInYears($joinDate);
                
                if ($yearsDiff >= 1) {
                    $experienceYears = $yearsDiff;
                } else {
                    $monthsDiff = Carbon::now()->diffInMonths($joinDate);
                    if ($monthsDiff >= 6) {
                        $experienceYears = "< 1";
                    } else {
                        $experienceYears = 0;
                    }
                }
            }
        }
        
        return view("profilpage", compact(
            'user', 
            'hasStore', 
            'userStore',
            'totalServices',
            'totalEarnings',
            'completedProjects',
            'joinDate',
            'experienceYears'
        ));
    }
}
