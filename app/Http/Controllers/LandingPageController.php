<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Jasa;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request) {
        $kategoris = Kategori::limit(9)->get();
        
        $query = Jasa::with(['store', 'jasa_banners']);
        
        // Handle search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }
        
        $jasas = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Preserve search parameter in pagination links
        if ($request->has('search')) {
            $jasas->appends(['search' => $request->search]);
        }
        
        return view("landingpage", compact("kategoris", "jasas"));
    }
}