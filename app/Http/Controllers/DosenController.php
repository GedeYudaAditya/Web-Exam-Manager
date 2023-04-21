<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    /**
     * @kegunaan
     * Menampilkan halaman manajemen media untuk dosen
     */
    public function media()
    {
        $data = [
            'title' => 'Manajemen Media'
        ];
        return view('dosen.manajemen-media', $data);
    }

    /**
     * @kegunaan
     * Menampilkan halaman manajemen test untuk dosen
     */
    public function test()
    {
        $data = [
            'title' => 'Manajemen Test',
            'users' => User::all()
        ];
        return view('dosen.manajemen-test', $data);
    }

    /**
     * @kegunaan
     * Melakukan acc pada user yang telah mendaftar
     */
    public function accUser(User $user)
    {
        $user->status = 'aktif';
        $user->save();

        return redirect()->back()->with('success', 'Berhasil menerima user');
    }

    /**
     * @kegunaan
     * Melakukan tolak pada user yang telah mendaftar
     */
    public function decUser(User $user)
    {
        $user->status = 'nonaktif';
        $user->save();

        return redirect()->back()->with('success', 'Berhasil menolak user');
    }

    /**
     * @kegunaan
     * Melakukan delet pada user yang telah mendaftar
     */
    public function delUser(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus user');
    }
}
