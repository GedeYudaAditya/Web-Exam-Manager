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

    /**
     * @kegunaan
     * Menampilkan halaman list media untuk mahasiswa
     */
    public function media()
    {
        $data = [
            'title' => 'Media'
        ];
        return view('mahasiswa.media', $data);
    }

    /**
     * @kegunaan
     * Menampilkan halaman list video untuk mahasiswa
     */
    public function video()
    {
        $data = [
            'title' => 'Video Pembelajaran'
        ];
        return view('mahasiswa.media.video', $data);
    }

    /**
     * @kegunaan
     * Menampilkan halaman detail video untuk mahasiswa
     */
    public function detailVideo($id)
    {
        $data = [
            'title' => 'Detail Video'
        ];

        return view('mahasiswa.media.detail_video', $data);
    }

    /**
     * @kegunaan
     * Menampilkan halaman list anatiomy3d untuk mahasiswa
     */
    public function anatomy3d()
    {
    }

    /**
     * @kegunaan
     * Menampilkan halaman detail anatomy3d untuk mahasiswa
     */
    public function detailAnatomy3d($id)
    {
    }

    /**
     * @kegunaan
     * Menampilkan halaman test untuk mahasiswa
     */
    public function test()
    {
    }
}