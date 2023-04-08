<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * @kegunaan
     * Menampilkan halaman utama untuk mahasiswa
     */
    public function index()
    {
        return view('mahasiswa.index');
    }
}
