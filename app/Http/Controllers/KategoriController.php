<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kategori\UpdateRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori', compact("kategori"));
    }

    public function delete($id)
    {
        Kategori::where("id", "=", $id)->delete();
        return redirect('/kategori');
    }

    public function edit($id)
    {
        $data = Kategori::where("id", "=", $id)->first();
        return view('editkategori', compact("id", "data"));
    }

    public function update(UpdateRequest $request, $id)
    {
        Kategori::where("id", "=", $id)->update([
            'nama' => $request->nama,
        ]);
        return redirect("/kategori");
    }
}
