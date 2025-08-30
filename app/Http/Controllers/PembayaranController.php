<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index($jasa_id) {
        // Ambil data jasa dengan relasi yang diperlukan
        $jasa = Jasa::with(['store.user', 'kategoris', 'banners'])->findOrFail($jasa_id);
        
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect('/auth/login')->with('error', 'Silakan login terlebih dahulu untuk melakukan pembayaran.');
        }
        
        // Pastikan user tidak membeli jasa sendiri
        if (auth()->id() === $jasa->store->id_user) {
            return redirect()->back()->with('error', 'Anda tidak dapat membeli jasa Anda sendiri.');
        }
        
        return view('pembayaran', compact('jasa'));
    }
}
