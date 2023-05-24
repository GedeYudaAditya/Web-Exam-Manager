<?php

namespace App\Http\Controllers;

use App\Exports\LeaderboardExport;
use App\Models\Question;
use App\Models\Report;
use App\Models\Test;
use App\Models\User;
use App\Exports\ReportExport;
use App\Models\Video;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

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
            'title' => 'Manajemen Media',
            'videos' => Video::all()
        ];
        return view('dosen.manajemen-media', $data);
    }

    public function manajemen()
    {
        $data = [
            'title' => 'Manajemen User',
        ];
        return view('dosen.media', $data);
    }

    public function anatomy3d()
    {
        $data = [
            'title' => 'Anatomy 3D',
        ];
        return view('dosen.anatomy3d.index', $data);
    }

    public function mediaDetail(Video $video)
    {
        $data = [
            'title' => 'Detail Media',
            'video' => $video
        ];
        return view('dosen.manajemen-media.index', $data);
    }

    public function mediaAdd()
    {
        $data = [
            'title' => 'Tambah Media'
        ];
        return view('dosen.manajemen-media.create', $data);
    }

    public function mediaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'embed' => 'required',
            'description' => 'required',
            'category' => 'required|in:paru,ginjal,reproduksi',
            'status' => 'required|in:draft,published'
        ]);

        try {
            Video::create([
                'slug' => Str::slug($request->name . '-' . time()),
                'name' => $request->name,
                'embed' => $request->embed,
                'description' => $request->description,
                'category' => $request->category,
                'status' => $request->status
            ]);
            return redirect()->route('dosen.media')->with('success', 'Berhasil menambah media');
        } catch (\Exception $e) {
            return redirect()->route('dosen.media.create')->with('error', 'Gagal menambah media');
        }
    }

    public function mediaEdit(Video $video)
    {
        $data = [
            'title' => 'Edit Media',
            'video' => $video
        ];
        return view('dosen.manajemen-media.edit', $data);
    }

    public function mediaUpdate(Request $request, Video $video)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'embed' => 'required',
            'description' => 'required',
            'category' => 'required|in:paru,ginjal,reproduksi',
            'status' => 'required|in:draft,published'
        ]);

        try {
            $video->name = $request->name;
            $video->embed = $request->embed;
            $video->description = $request->description;
            $video->category = $request->category;
            $video->status = $request->status;
            $video->save();
            return redirect()->route('dosen.media')->with('success', 'Berhasil mengubah media');
        } catch (\Exception $e) {
            return redirect()->route('dosen.media')->with('error', 'Gagal mengubah media');
        }
    }

    public function mediaDelete(Video $video)
    {
        try {
            $video->delete();
            return redirect()->route('dosen.media')->with('success', 'Berhasil menghapus media');
        } catch (\Exception $e) {
            return redirect()->route('dosen.media')->with('error', 'Gagal menghapus media');
        }
    }

    public function ubahStatus(Video $video)
    {
        if ($video->status == 'published') {
            $video->status = 'draft';
        } else {
            $video->status = 'published';
        }
        $video->save();
        return redirect()->route('dosen.media')->with('success', 'Berhasil mengubah status media');
    }


    /**
     * @kegunaan
     * Menampilkan halaman manajemen test untuk dosen
     */
    public function test()
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
            'title' => 'Manajemen Test',
            'users' => User::all(),
            'leaderboard' => [
                'paru' => $paru,
                'ginjal' => $ginjal,
                'reproduksi' => $reproduksi
            ]
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

    public function report()
    {
        $data = [
            'title' => 'Laporan Test',
        ];
        return view('dosen.test.report', $data);
    }

    public function detailReport(Report $report)
    {
        $data = [
            'title' => 'Hasil Test',
            'report' => $report,
        ];
        return view('dosen.test.detail-report', $data);
    }

    public function exportHasil()
    {
        return Excel::download(new ReportExport, 'hasil.xlsx');
    }

    public function exportLeaderboard(Report $report)
    {
        return Excel::download(new LeaderboardExport($report), 'leaderboard-detail.xlsx');
    }
}
