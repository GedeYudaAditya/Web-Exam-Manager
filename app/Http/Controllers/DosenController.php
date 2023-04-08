<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * @kegunaan
     * Menampilkan halaman utama untuk dosen
     */
    public function index(){
        return view('dosen.index');
    }
}
