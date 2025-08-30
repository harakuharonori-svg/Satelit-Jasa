<?php

namespace App\Http\Controllers;

use App\Http\Requests\Toko\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BuatTokoController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah memiliki toko
        $userStore = Store::where('id_user', Auth::id())->first();
        
        if ($userStore) {
            return redirect('/profil')->with('error', 'Anda sudah memiliki toko. Tidak dapat membuat toko baru.');
        }
        
        return view('buattoko');
    }

    public function store(StoreRequest $request)
    {
        // Cek kembali apakah user sudah memiliki toko
        $existingStore = Store::where('id_user', Auth::id())->first();
        
        if ($existingStore) {
            return redirect('/profil')->with('error', 'Anda sudah memiliki toko. Tidak dapat membuat toko baru.');
        }

        // Handle file upload untuk KTP
        $ktpPath = null;
        if ($request->hasFile('ktp')) {
            $ktpFile = $request->file('ktp');
            $ktpPath = $ktpFile->store('ktp', 'public');
        }

        // Buat toko baru
        $store = Store::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto_ktp' => $ktpPath,
            'id_user' => Auth::id()
        ]);

        return redirect()->route('toko.show', $store->id)->with('success', 'Toko berhasil dibuat! Selamat datang di dunia bisnis digital.');
    }
}
