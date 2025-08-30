<?php

namespace App\Http\Controllers;

use App\Http\Requests\Jasa\StoreRequest;
use App\Models\Jasa;
use App\Models\Jasa_banner;
use App\Models\Store;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BuatJasaController extends Controller
{
    public function index() 
    {
        // Cek apakah user sudah login dan punya toko
        if (!Auth::check()) {
            return redirect('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userStore = Store::where('id_user', Auth::id())->first();
        
        if (!$userStore) {
            return redirect('/buattoko')->with('error', 'Anda belum memiliki toko. Silakan buat toko terlebih dahulu.');
        }

        $kategoris = Kategori::all();

        return view('buatjasa', compact('kategoris'));
    }

    public function store(StoreRequest $request)
    {
        // Cek lagi apakah user punya toko
        $userStore = Store::where('id_user', Auth::id())->first();
        
        if (!$userStore) {
            return redirect('/buattoko')->with('error', 'Anda belum memiliki toko. Silakan buat toko terlebih dahulu.');
        }

        // Buat jasa baru
        $jasa = Jasa::create([
            'id_store' => $userStore->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga
        ]);

        // Attach kategoris to jasa
        if ($request->has('kategoris')) {
            $jasa->kategoris()->attach($request->kategoris);
        }

        // Handle upload banner
        if ($request->hasFile('banner')) {
            foreach ($request->file('banner') as $banner) {
                $bannerPath = $banner->store('jasa-banners', 'public');
                
                Jasa_banner::create([
                    'id_jasa' => $jasa->id,
                    'image' => $bannerPath
                ]);
            }
        }

        return redirect()->route('toko.show', $userStore->id)->with('success', 'Jasa berhasil dibuat! Selamat, jasa Anda sudah tersedia untuk pelanggan.');
    }
}
