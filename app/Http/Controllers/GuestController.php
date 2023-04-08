<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * @kegunaan
     * Menampilkan halaman utama untuk guest
     */
    public function index()
    {
        $data = [
            'title' => 'Halaman Utama',
            'content' => 'Selamat datang di halaman utama'
        ];
        return view('index', $data);
    }

    /**
     * @kegunaan
     * Melakukan proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
