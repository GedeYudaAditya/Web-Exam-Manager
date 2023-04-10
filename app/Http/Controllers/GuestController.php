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
            'content' => 'Selamat datang di halaman utama pengunjung, anda dapat login untuk mulai beraktifitas. :D'
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

        return back()->with('error', 'Pastikan akun dan password dimasukkan dengan benar!',);
    }

    /**
     * @kegunaan
     * Melakukan proses logout
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('landing-page');
    }
}
