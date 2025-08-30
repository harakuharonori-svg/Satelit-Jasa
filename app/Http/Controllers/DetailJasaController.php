<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Store;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DetailJasaController extends Controller
{
    public function show($id)
    {
        // Ambil data jasa dengan relasi yang diperlukan
        $jasa = Jasa::with(['jasa_banners', 'store.user', 'kategoris'])
            ->findOrFail($id);
        
        // Ambil statistik penyedia jasa
        $store = $jasa->store;
        $totalServices = Jasa::where('id_store', $store->id)->count();
        
        // Count completed projects: only projects that are paid and completed
        $completedProjects = Transaksi::whereHas('jasa', function($query) use ($store) {
            $query->where('id_store', $store->id);
        })
        ->where('payment_status', 'paid') // Only count paid orders
        ->where('order_status', 'completed') // Only count completed projects
        ->count();
        
        // Fallback: if no completed projects found with new system, 
        // check old system but only count if there are no new-style orders
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
        
        // Ambil rekomendasi jasa lain (exclude jasa saat ini)
        $recommendations = Jasa::with('jasa_banners')
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(10)
            ->get();
        
        return view('detailjasa', compact(
            'jasa',
            'store', 
            'totalServices',
            'completedProjects',
            'recommendations'
        ));
    }
}
