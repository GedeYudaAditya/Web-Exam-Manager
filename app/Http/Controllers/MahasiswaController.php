<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Test;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        // dd('it works');
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
            'title' => 'Video Pembelajaran',
            'videos' => Video::where('status', 'published')->get()->sortByDesc('created_at')
        ];
        return view('mahasiswa.media.video', $data);
    }

    /**
     * @kegunaan
     * Menampilkan halaman detail video untuk mahasiswa
     */
    public function detailVideo(Video $video)
    {
        $data = [
            'title' => 'Detail Video',
            'video' => $video,
        ];

        return view('mahasiswa.media.detail_video', $data);
    }

    /**
     * @kegunaan
     * Menampilkan halaman list anatiomy3d untuk mahasiswa
     */
    public function anatomy3d()
    {
        $data = [
            'title' => 'Anatomy 3D'
        ];
        return view('mahasiswa.anatomy3d.index', $data);
    }

    /**
     * @kegunaan
     * Menampilkan halaman detail anatomy3d untuk mahasiswa
     */
    public function detailAnatomy3d($id)
    {
        $data = [
            'title' => 'Detail Anatomy 3D',
        ];
        if ($id == 'paru') {
            return view('mahasiswa.anatomy3d.paru3d', $data);
        } elseif ($id == 'ginjal') {
            return view('mahasiswa.anatomy3d.ginjal3d', $data);
        } elseif ($id == 'reproduksi') {
            return view('mahasiswa.anatomy3d.rep3d', $data);
        }
    }

    /**
     * @kegunaan
     * Menampilkan halaman test untuk mahasiswa
     */
    public function test()
    {
        $data = [
            'title' => 'Test'
        ];
        return view('mahasiswa.test', $data);
    }

    /**
     * @kegunaan
     * Menampilkan test untuk paru-paru
     */
    public function paruParuTest()
    {
        $data = [
            'title' => 'Test Paru-paru',
            'jenis' => 'Paru-paru'
        ];
        return view('mahasiswa.test.index', $data);
    }

    /**
     * @kegunaan
     * Menampilkan soal test untuk paru-paru
     */
    public function paruParuTestSoal(Test $test)
    {
        $data = [
            'title' => 'Test Paru-paru',
            'jenis' => 'Paru-paru',
            'test' => $test,
            'soals' => $test->questions->shuffle(),
            'route_back' => route('mahasiswa.test.paru-paru')
        ];
        return view('mahasiswa.test.soal.index', $data);
    }

    /**
     * @kegunaan
     * Menampilkan test untuk ginjal
     */
    public function ginjalTest()
    {
        $data = [
            'title' => 'Test Ginjal',
            'jenis' => 'Ginjal'
        ];
        return view('mahasiswa.test.index', $data);
    }

    /**
     * @kegunaan
     * Menampilkan soal test untuk ginjal
     */
    public function ginjalTestSoal(Test $test)
    {
        $data = [
            'title' => 'Test Ginjal',
            'jenis' => 'Ginjal',
            'test' => $test,
            'soals' => $test->questions->shuffle(),
            'route_back' => route('mahasiswa.test.ginjal')
        ];
        return view('mahasiswa.test.soal.index', $data);
    }

    /**
     * @kegunaan
     * Menampilkan test untuk reproduksi
     */
    public function reproduksiTest()
    {
        $data = [
            'title' => 'Test Reproduksi',
            'jenis' => 'Reproduksi'
        ];
        return view('mahasiswa.test.index', $data);
    }

    /**
     * @kegunaan
     * Menampilkan soal test untuk reproduksi
     */
    public function reproduksiTestSoal(Test $test)
    {
        $data = [
            'title' => 'Test Reproduksi',
            'jenis' => 'Reproduksi',
            'test' => $test,
            'soals' => $test->questions->shuffle(),
            'route_back' => route('mahasiswa.test.reproduksi')
        ];
        return view('mahasiswa.test.soal.index', $data);
    }

    public function makeAttampt(Request $request, Test $test)
    {

        // Check berapa pertanyaan yang ada di test
        $manyQuestions = $test->questions->count();

        // check jawaban yang benar
        $correctAnswer = 0;
        $correctAnswerScore = 0;
        $fullScore = 0;

        DB::beginTransaction();
        try {
            foreach ($request->all() as $key => $value) {
                if ($key != '_token') {
                    $questionSlug = $key;
                    $answer = $value;

                    // Check apakah jawaban sudah ada di database
                    $databaseQuestion = $test->questions()->where('slug', $questionSlug)->first();

                    // Check apakah jawaban benar
                    if ($databaseQuestion->type == 'multiple_choice') {
                        if ($answer == $databaseQuestion->correct_answer) {
                            $correctAnswerScore = $correctAnswerScore + $databaseQuestion->score;
                            $correctAnswer++;
                        }
                    } else {
                        if ($answer != null) {
                            $correctAnswerScore = $correctAnswerScore + $databaseQuestion->score;
                            $correctAnswer++;
                        }
                    }

                    $fullScore = $fullScore + $databaseQuestion->score;
                }
            }

            // Hitung score
            $score = ($correctAnswerScore / $fullScore) * 100;

            $report = $test->reports()->create([
                'slug' => $this->slug(auth()->user()->name),
                'user_id' => auth()->user()->id,
                'test_id' => $test->id,
                'score' => $score,
                'correct_answer' => $correctAnswer,
            ]);

            $answerUser = '';

            foreach ($request->all() as $key => $value) {
                if ($key != '_token') {
                    $questionSlug = $key;
                    $answer = $value;

                    // buat detail report
                    $databaseQuestion = $test->questions()->where('slug', $questionSlug)->first();

                    if ($answer == $databaseQuestion->correct_answer) {
                        $answerUser = true;
                    } else {
                        $answerUser = false;
                    }

                    if ($databaseQuestion->type == 'essay') {
                        if ($answer == null) {
                            $report->detailReports()->create([
                                'question_id' => $databaseQuestion->id,
                                'essay_answer' => $value,
                                'is_correct' => false,
                            ]);
                        } else {
                            $report->detailReports()->create([
                                'question_id' => $databaseQuestion->id,
                                'essay_answer' => $value,
                                'is_correct' => true,
                            ]);
                        }
                    } else {
                        $report->detailReports()->create([
                            'question_id' => $databaseQuestion->id,
                            'user_answer' => $value,
                            'is_correct' => $answerUser,
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('mahasiswa.test.result', $report->slug);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan coba lagi');
        }
    }

    public function report()
    {
        $data = [
            'title' => 'Laporan Test',
        ];
        return view('mahasiswa.test.report', $data);
    }

    public function result(Report $report)
    {
        $data = [
            'title' => 'Hasil Test',
            'report' => $report,
        ];
        return view('mahasiswa.test.result', $data);
    }

    /**
     * @kegunaan
     * Melakukan sluging berdasarkan waktu di buat dengan timestamp
     */
    private function slug($name)
    {
        $name = Str::limit($name, 50);
        $slug = Str::slug($name . '-' . time());
        return $slug;
    }
}
