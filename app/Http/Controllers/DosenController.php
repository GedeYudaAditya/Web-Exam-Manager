<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * @kegunaan
     * Menampilkan halaman utama untuk dosen
     */
    public function index()
    {
        $data = [
            'title' => 'Halaman Dosen',
            'content' => 'Selamat datang di halaman dashboard dosen'
        ];
        return view('dosen.index', $data);
    }
}
