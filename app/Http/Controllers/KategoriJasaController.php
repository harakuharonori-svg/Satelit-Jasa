<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriJasaController extends Controller
{
    public function index() {
        $data = Kategori::all();
        return view('kategorijasa', compact("data"));
    }
}
