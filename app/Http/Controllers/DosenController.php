<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Test;
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
     * Melakukan delete pada user yang telah mendaftar
     */
    public function delUser(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus user');
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk melihat test paru-paru
     */
    public function paruParuTest()
    {
        $data = [
            'title' => 'Paru-Paru Test',
            'jenis' => 'Paru-Paru',
            'route_create' => route('dosen.test.paru-paru.create')
        ];

        return view('dosen.test.index', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk membuat test paru-paru
     */
    public function createParuParuTest()
    {
        $data = [
            'title' => 'Paru-Paru Test',
            'jenis' => 'Paru-Paru',
            'route_store' => route('dosen.test.paru-paru.store'),
            'route_back' => route('dosen.test.paru-paru')
        ];

        return view('dosen.test.create', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk mengedit test paru-paru
     */
    public function editParuParuTest(Test $test)
    {
        $data = [
            'title' => 'Paru-Paru Test',
            'jenis' => 'Paru-Paru',
            'route_update' => route('dosen.test.paru-paru.update', $test->slug),
            'route_back' => route('dosen.test.paru-paru'),
            'test' => $test
        ];

        return view('dosen.test.edit', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk melihat soal test paru-paru
     */
    public function paruParuSoal(Test $test)
    {
        $data = [
            'title' => 'Paru-Paru Test',
            'jenis' => 'Paru-Paru',
            'route_create' => route('dosen.test.paru-paru.soal.create', $test->slug),
            'route_edit' => 'dosen.test.paru-paru.soal.edit',
            'route_delete' => 'dosen.test.paru-paru.soal.delete',
            'route_back' => route('dosen.test.paru-paru'),
            'test' => $test,
            'soals' => $test->questions
        ];

        return view('dosen.test.soal.index', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk membuat soal test paru-paru
     */
    public function createParuParuSoal(Test $test)
    {
        $data = [
            'title' => 'Paru-Paru Test',
            'jenis' => 'Paru-Paru',
            'route_store' => route('dosen.test.paru-paru.soal.store', $test->slug),
            'route_back' => route('dosen.test.paru-paru.soal', $test->slug),
            'test' => $test
        ];

        return view('dosen.test.soal.create', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk mengedit soal test paru-paru
     */
    public function editParuParuSoal(Test $test, Question $question)
    {
        $data = [
            'title' => 'Paru-Paru Test',
            'jenis' => 'Paru-Paru',
            'route_update' => route('dosen.test.paru-paru.soal.update', [$test->slug, $question->slug]),
            'route_back' => route('dosen.test.paru-paru.soal', $test->slug),
            'test' => $test,
            'soal' => $question
        ];

        return view('dosen.test.soal.edit', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk melihat test ginjal
     */
    public function ginjalTest()
    {
        $data = [
            'title' => 'Ginjal Test',
            'jenis' => 'Ginjal',
            'route_create' => route('dosen.test.ginjal.create')
        ];

        return view('dosen.test.index', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk membuat test ginjal
     */
    public function createGinjalTest()
    {
        $data = [
            'title' => 'Ginjal Test',
            'jenis' => 'Ginjal',
            'route_store' => route('dosen.test.ginjal.store'),
            'route_back' => route('dosen.test.ginjal')
        ];

        return view('dosen.test.create', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk mengedit test ginjal
     */
    public function editGinjalTest(Test $test)
    {
        $data = [
            'title' => 'Ginjal Test',
            'jenis' => 'Ginjal',
            'route_update' => route('dosen.test.ginjal.update', $test->slug),
            'route_back' => route('dosen.test.ginjal'),
            'test' => $test
        ];

        return view('dosen.test.edit', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk melihat soal test ginjal
     */
    public function ginjalSoal(Test $test)
    {
        $data = [
            'title' => 'Ginjal Test',
            'jenis' => 'Ginjal',
            'route_create' => route('dosen.test.ginjal.soal.create', $test->slug),
            'route_edit' => 'dosen.test.ginjal.soal.edit',
            'route_delete' => 'dosen.test.ginjal.soal.delete',
            'route_back' => route('dosen.test.ginjal'),
            'test' => $test,
            'soals' => $test->questions
        ];

        return view('dosen.test.soal.index', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk membuat soal test ginjal
     */
    public function createGinjalSoal(Test $test)
    {
        $data = [
            'title' => 'Ginjal Test',
            'jenis' => 'Ginjal',
            'route_store' => route('dosen.test.ginjal.soal.store', $test->slug),
            'route_back' => route('dosen.test.ginjal.soal', $test->slug),
            'test' => $test
        ];

        return view('dosen.test.soal.create', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk mengedit soal test ginjal
     */
    public function editGinjalSoal(Test $test, Question $question)
    {
        $data = [
            'title' => 'Ginjal Test',
            'jenis' => 'Ginjal',
            'route_update' => route('dosen.test.ginjal.soal.update', [$test->slug, $question->slug]),
            'route_back' => route('dosen.test.ginjal.soal', $test->slug),
            'test' => $test,
            'soal' => $question
        ];

        return view('dosen.test.soal.edit', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk melihat test reproduksi
     */
    public function reproduksiTest()
    {
        $data = [
            'title' => 'Reproduksi Test',
            'jenis' => 'Reproduksi',
            'route_create' => route('dosen.test.reproduksi.create')
        ];

        return view('dosen.test.index', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk membuat test reproduksi
     */
    public function createReproduksiTest()
    {
        $data = [
            'title' => 'Reproduksi Test',
            'jenis' => 'Reproduksi',
            'route_store' => route('dosen.test.reproduksi.store'),
            'route_back' => route('dosen.test.reproduksi')
        ];

        return view('dosen.test.create', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk mengedit test reproduksi
     */
    public function editReproduksiTest(Test $test)
    {
        $data = [
            'title' => 'Reproduksi Test',
            'jenis' => 'Reproduksi',
            'route_update' => route('dosen.test.reproduksi.update', $test->slug),
            'route_back' => route('dosen.test.reproduksi'),
            'test' => $test
        ];

        return view('dosen.test.edit', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk melihat soal test reproduksi
     */
    public function reproduksiSoal(Test $test)
    {
        $data = [
            'title' => 'Reproduksi Test',
            'jenis' => 'Reproduksi',
            'route_create' => route('dosen.test.reproduksi.soal.create', $test->slug),
            'route_edit' => 'dosen.test.reproduksi.soal.edit',
            'route_delete' => 'dosen.test.reproduksi.soal.delete',
            'route_back' => route('dosen.test.reproduksi'),
            'test' => $test,
            'soals' => $test->questions
        ];

        return view('dosen.test.soal.index', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk membuat soal test reproduksi
     */
    public function createReproduksiSoal(Test $test)
    {
        $data = [
            'title' => 'Reproduksi Test',
            'jenis' => 'Reproduksi',
            'route_store' => route('dosen.test.reproduksi.soal.store', $test->slug),
            'route_back' => route('dosen.test.reproduksi.soal', $test->slug),
            'test' => $test
        ];

        return view('dosen.test.soal.create', $data);
    }

    /**
     * @kegunaan
     * Mengarahkan ke page untuk mengedit soal test reproduksi
     */
    public function editReproduksiSoal(Test $test, Question $question)
    {
        $data = [
            'title' => 'Reproduksi Test',
            'jenis' => 'Reproduksi',
            'route_update' => route('dosen.test.reproduksi.soal.update', [$test->slug, $question->slug]),
            'route_back' => route('dosen.test.reproduksi.soal', $test->slug),
            'test' => $test,
            'soal' => $question
        ];

        return view('dosen.test.soal.edit', $data);
    }
}
