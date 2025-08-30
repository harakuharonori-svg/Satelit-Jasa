<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Roomchat;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat($storeId = null)
    {
        if (!Auth::check()) {
            return redirect('/auth/login')->with('error', 'Silakan login terlebih dahulu untuk menggunakan fitur chat.');
        }

        if ($storeId) {
            // Chat dengan toko tertentu
            $store = Store::with('user')->findOrFail($storeId);
            $storeOwner = $store->user;
            
            // Cek apakah user mencoba chat dengan dirinya sendiri
            if (Auth::id() == $store->id_user) {
                return redirect()->back()->with('error', 'Anda tidak dapat chat dengan toko Anda sendiri.');
            }

            // Cari atau buat room chat antara user dan store owner
            $roomchat = Roomchat::where(function($query) use ($store) {
                $query->where('id_user1', Auth::id())
                      ->where('id_user2', $store->id_user);
            })->orWhere(function($query) use ($store) {
                $query->where('id_user1', $store->id_user)
                      ->where('id_user2', Auth::id());
            })->with(['chats' => function($query) {
                $query->orderBy('created_at', 'asc');
            }])->first();

            // Jika belum ada room chat, buat baru
            if (!$roomchat) {
                $roomchat = Roomchat::create([
                    'id_user1' => Auth::id(),
                    'id_user2' => $store->id_user
                ]);
                // Load empty chats relation
                $roomchat->load('chats');
            }

            return view("chat", compact('roomchat', 'store'));
        }

        // Jika tidak ada storeId, tampilkan daftar chat rooms
        $userRooms = Roomchat::where('id_user1', Auth::id())
                             ->orWhere('id_user2', Auth::id())
                             ->with(['user1', 'user2', 'chats' => function($query) {
                                 $query->latest()->first();
                             }])
                             ->orderBy('updated_at', 'desc')
                             ->get();

        return view("chat", compact('userRooms'));
    }

    public function sendMessage(Request $request, $store_id)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $store = Store::with('user')->findOrFail($store_id);
            $user = auth()->user();

            // Find or create roomchat
            $roomchat = Roomchat::where(function($query) use ($user, $store) {
                $query->where('id_user1', $user->id)
                      ->where('id_user2', $store->id_user);
            })->orWhere(function($query) use ($user, $store) {
                $query->where('id_user1', $store->id_user)
                      ->where('id_user2', $user->id);
            })->first();

            if (!$roomchat) {
                $roomchat = Roomchat::create([
                    'id_user1' => $user->id,
                    'id_user2' => $store->id_user
                ]);
            }

            // Create message
            $chat = Chat::create([
                'id_room' => $roomchat->id,
                'id_user' => $user->id,
                'massage' => $request->message
            ]);

            // TODO: Broadcast to Pusher
            // broadcast(new NewMessage($chat))->toOthers();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => [
                        'id' => $chat->id,
                        'message' => $chat->massage,
                        'user_id' => $chat->id_user,
                        'created_at' => $chat->created_at->format('H:i')
                    ]
                ]);
            }

            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
            
        } catch (\Exception $e) {
            \Log::error('Chat send message error: ' . $e->getMessage());
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Gagal mengirim pesan: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
        }
    }
}
