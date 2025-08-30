<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kategori\StoreRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TambahKategoriController extends Controller
{
    public function index()
    {
        return view('tambahkategori');
    }

    public function store(StoreRequest $request)
    {
        Kategori::create([
            'nama' => $request->nama,
        ]);
        return redirect("/kategori/tambah");
    }
}
