<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Kategori;
use App\Models\Jasa_banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditJasaController extends Controller
{
    public function index($id)
    {
        $jasa = Jasa::with(['store', 'jasa_banners', 'kategoris'])->findOrFail($id);
        
        // Check if user owns this jasa
        if (Auth::user()->id !== $jasa->store->id_user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit jasa ini.');
        }
        
        $kategoris = Kategori::all();
        
        return view('editjasa', compact('jasa', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $jasa = Jasa::with('store')->findOrFail($id);
        
        // Check if user owns this jasa
        if (Auth::user()->id !== $jasa->store->id_user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit jasa ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:1000',
            'kategoris' => 'required|array|min:1',
            'kategoris.*' => 'exists:kategoris,id',
            'banners.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update jasa data
        $jasa->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        // Update kategori relationships
        $jasa->kategoris()->sync($request->kategoris);

        // Handle new banner uploads
        if ($request->hasFile('banners')) {
            foreach ($request->file('banners') as $banner) {
                $path = $banner->store('jasa_banners', 'public');
                
                Jasa_banner::create([
                    'id_jasa' => $jasa->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('jasa.detail', $jasa->id)->with('success', 'Jasa berhasil diperbarui!');
    }

    public function deleteBanner($id)
    {
        $banner = Jasa_banner::findOrFail($id);
        $jasa = $banner->jasa;
        
        // Check if user owns this jasa
        if (Auth::user()->id !== $jasa->store->id_user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete file from storage
        if (Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        // Delete from database
        $banner->delete();

        return response()->json(['success' => 'Banner berhasil dihapus']);
    }
}
