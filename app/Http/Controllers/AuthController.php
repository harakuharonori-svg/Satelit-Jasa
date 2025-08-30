<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register\StoreRequest;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }
    public function register()
    {
        return view("auth.register");
    }

    public function store(StoreRequest $request)
    {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telp,
            'password' => Hash::make($request->password),
            'role' => "USER"
        ]);
        return redirect("/auth/register")->with('success', 'Pendaftaran berhasil! Selamat datang di SatelitJasa.');
    }

    public function login(\App\Http\Requests\Login\StoreRequest $request)
    {
        try {
            $login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            if ($login) {
                return redirect('/');
            } else {
                return redirect('/auth/login')->withErrors(['password' => 'Kata sandi salah!']);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}