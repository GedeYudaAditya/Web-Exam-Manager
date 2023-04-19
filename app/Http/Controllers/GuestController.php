<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
     * Melakukan proses registrasi
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'mahasiswa',
                'password' => Hash::make($request->password),
            ]);
            DB::commit();
            return redirect()->route('landing-page')->with('success', 'Akun berhasil dibuat, silahkan login untuk mulai beraktifitas. :D');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Akun dengan email tersebut sudah terdaftar, silahkan gunakan email lainnya!',);
        }
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
