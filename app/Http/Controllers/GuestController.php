<?php

namespace App\Http\Controllers;

use App\Models\Report;
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
            if (auth()->user()->status == 'aktif') {
                $request->session()->regenerate();
                return redirect()->intended('/');
            } else {
                auth()->logout();
                return back()->with('error', 'Akun anda belum aktif, silahkan hubungi dosen untuk mengaktifkan akun anda!',);
            }
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

    public function about()
    {
        $data = [
            'title' => 'Tentang',
            'content' => 'Selamat datang di halaman tentang pengunjung, anda dapat login untuk mulai beraktifitas. :D'
        ];
        return view('about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Kontak',
            'content' => 'Selamat datang di halaman kontak pengunjung, anda dapat login untuk mulai beraktifitas. :D'
        ];
        return view('contact', $data);
    }

    public function leaderboard()
    {
        $paru = Report::select('test.name as Test Name', 'user.name as Username', 'reports.score', 'reports.created_at as Created At', 'user.nim as nim')
            ->join('users as user', 'user.id', '=', 'reports.user_id')
            ->join('tests as test', 'test.id', '=', 'reports.test_id')
            ->groupBy('test.id', 'test.name', 'user.name', 'user.nim', 'reports.score', 'reports.created_at')
            ->orderBy('test.id', 'asc')
            ->orderBy('reports.score', 'desc')
            ->orderBy('user.name', 'asc')
            ->orderBy('user.nim', 'asc')
            ->orderBy('reports.created_at', 'desc')
            ->where('test.category', 'paru')
            // if user have tried the test more than once, only take the best score and hide the rest
            ->havingRaw('reports.score = max(reports.score)')
            ->get();

        $paru->transform(function ($item) {
            $item->score = $item->score . '%';
            return $item;
        });

        $ginjal = Report::select('test.name as Test Name', 'user.name as Username', 'reports.score', 'reports.created_at as Created At', 'user.nim as nim')
            ->join('users as user', 'user.id', '=', 'reports.user_id')
            ->join('tests as test', 'test.id', '=', 'reports.test_id')
            ->groupBy('test.id', 'test.name', 'user.name', 'user.nim', 'reports.score', 'reports.created_at')
            ->orderBy('test.id', 'asc')
            ->orderBy('reports.score', 'desc')
            ->orderBy('user.name', 'asc')
            ->orderBy('user.nim', 'asc')
            ->orderBy('reports.created_at', 'desc')
            ->where('test.category', 'ginjal')
            // if user have tried the test more than once, only take the best score and hide the rest
            ->havingRaw('reports.score = max(reports.score)')
            ->get();

        $ginjal->transform(function ($item) {
            $item->score = $item->score . '%';
            return $item;
        });

        $reproduksi = Report::select('test.name as Test Name', 'user.name as Username', 'reports.score', 'reports.created_at as Created At', 'user.nim as nim')
            ->join('users as user', 'user.id', '=', 'reports.user_id')
            ->join('tests as test', 'test.id', '=', 'reports.test_id')
            ->groupBy('test.id', 'test.name', 'user.name', 'user.nim', 'reports.score', 'reports.created_at')
            ->orderBy('test.id', 'asc')
            ->orderBy('reports.score', 'desc')
            ->orderBy('user.name', 'asc')
            ->orderBy('user.nim', 'asc')
            ->orderBy('reports.created_at', 'desc')
            ->where('test.category', 'reproduksi')
            // if user have tried the test more than once, only take the best score and hide the rest
            ->havingRaw('reports.score = max(reports.score)')
            ->get();

        $reproduksi->transform(function ($item) {
            $item->score = $item->score . '%';
            return $item;
        });

        $data = [
            'title' => 'Kontak',
            'content' => 'Selamat datang di halaman kontak pengunjung, anda dapat login untuk mulai beraktifitas. :D',
            'leaderboard' => [
                'paru' => $paru,
                'ginjal' => $ginjal,
                'reproduksi' => $reproduksi
            ]
        ];

        return view('leaderboard', $data);
    }
}
