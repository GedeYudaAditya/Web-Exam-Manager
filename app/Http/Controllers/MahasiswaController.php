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
        $data = [
            'title' => 'Halaman Mahasiswa',
            'content' => 'Selamat datang di halaman utama mahasiswa, belajarlah dengan tekun :)'
        ];
        return view('mahasiswa.index', $data);
    }
}
