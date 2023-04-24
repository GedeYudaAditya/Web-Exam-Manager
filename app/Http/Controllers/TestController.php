<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestController extends Controller
{

    // ==================== PARU-PARU ====================

    /**
     * @kegunaan
     * Melakukan store test paru-paru
     */
    public function storeParuParuTest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'passing_score' => 'required',
            'duration' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $test = new Test;
            $test->slug = self::slug($request->name);
            $test->name = $request->name;
            $test->description = $request->description;
            $test->category = 'paru';
            $test->passing_score = $request->passing_score;
            $test->duration = $request->duration;
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.paru-paru')->with('success', 'Berhasil menambahkan test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan test');
        }
    }

    /**
     * @kegunaan
     * Melakukan update test paru-paru
     */
    public function updateParuParuTest(Request $request, Test $test)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'passing_score' => 'required',
            'duration' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $test->slug = self::slug($request->name);
            $test->name = $request->name;
            $test->description = $request->description;
            $test->category = 'paru';
            $test->passing_score = $request->passing_score;
            $test->duration = $request->duration;
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.paru-paru')->with('success', 'Berhasil mengubah test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengubah test');
        }
    }

    /**
     * @kegunaan
     * Melakukan delete test paru-paru
     */
    public function deleteParuParuTest(Test $test)
    {
        DB::beginTransaction();
        try {
            $test->delete();
            DB::commit();
            return redirect()->route('dosen.test.paru-paru')->with('success', 'Berhasil menghapus test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus test');
        }
    }

    /**
     * @kegunaan
     * Melakukan update status test paru-paru
     */
    public function updateStatusParuParuTest(Test $test)
    {
        // dd($test);
        DB::beginTransaction();
        try {
            $test->status = $test->status == 'draft' ? 'published' : 'draft';
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.paru-paru')->with('success', 'Berhasil mempublish test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mempublish test');
        }
    }

    /**
     * @kegunaan
     * Melakukan store soal test paru-paru
     */
    public function storeParuParuSoal(Request $request, Test $test)
    {
        // check if test is essay or not
        if ($request->type == 'essay') {
            $request->validate([
                'question' => 'required',
                'score' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $test->questions()->create([
                    'slug' => self::slug($request->question),
                    'question' => $request->question,
                    'score' => $request->score,
                    // 'test_id' => $test->id,
                    'type' => 'essay',
                ]);
                DB::commit();
                return redirect()->route('dosen.test.paru-paru.soal', $test->slug)->with('success', 'Berhasil menambahkan soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal menambahkan soal');
            }
        } else {
            $request->validate([
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'option_e' => 'nullable',
                'score' => 'required',
                'correct_answer' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $test->questions()->create([
                    'slug' => self::slug($request->question),
                    'question' => $request->question,
                    'option_a' => $request->option_a,
                    'option_b' => $request->option_b,
                    'option_c' => $request->option_c,
                    'option_d' => $request->option_d,
                    'option_e' => $request->option_e,
                    'score' => $request->score,
                    'correct_answer' => $request->correct_answer,
                    'type' => 'multiple_choice',
                ]);
                DB::commit();
                return redirect()->route('dosen.test.paru-paru.soal', $test->slug)->with('success', 'Berhasil menambahkan soal');
            } catch (\Exception $e) {
                DB::rollback();
                dd($e);
                return redirect()->back()->with('error', 'Gagal menambahkan soal');
            }
        }
    }

    /**
     * @kegunaan
     * Melakukan update soal test paru-paru
     */
    public function updateParuParuSoal(Request $request, Test $test, Question $question)
    {
        // check if test is essay or not
        if ($request->type == 'essay') {
            $request->validate([
                'question' => 'required',
                'score' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->score = $request->score;
                $question->correct_answer = null;
                $question->type = 'essay';
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.paru-paru.soal', $test->slug)->with('success', 'Berhasil mengubah soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal mengubah soal');
            }
        } else {
            $request->validate([
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'option_e' => 'nullable',
                'score' => 'required',
                'correct_answer' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->option_a = $request->option_a;
                $question->option_b = $request->option_b;
                $question->option_c = $request->option_c;
                $question->option_d = $request->option_d;
                $question->option_e = $request->option_e;
                $question->score = $request->score;
                $question->correct_answer = $request->correct_answer;
                $question->type = 'multiple_choice';
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.paru-paru.soal', $test->slug)->with('success', 'Berhasil mengubah soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal mengubah soal');
            }
        }
    }
    /**
     * @kegunaan
     * Melakukan delete soal test paru-paru
     */
    public function deleteParuParuSoal(Test $test, Question $question)
    {
        DB::beginTransaction();
        try {
            $question->delete();
            DB::commit();
            return redirect()->route('dosen.test.paru-paru.soal', $test->slug)->with('success', 'Berhasil menghapus soal');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus soal');
        }
    }

    // ============== GINJAL ==============

    /**
     * @kegunaan
     * Melakukan store test ginjal
     */
    public function storeGinjalTest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'passing_score' => 'required',
            'duration' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $test = new Test;
            $test->slug = self::slug($request->name);
            $test->name = $request->name;
            $test->description = $request->description;
            $test->category = 'ginjal';
            $test->passing_score = $request->passing_score;
            $test->duration = $request->duration;
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.ginjal')->with('success', 'Berhasil menambahkan test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan test');
        }
    }

    /**
     * @kegunaan
     * Melakukan update test ginjal
     */
    public function updateGinjalTest(Request $request, Test $test)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'passing_score' => 'required',
            'duration' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $test->slug = self::slug($request->name);
            $test->name = $request->name;
            $test->description = $request->description;
            $test->category = 'ginjal';
            $test->passing_score = $request->passing_score;
            $test->duration = $request->duration;
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.ginjal')->with('success', 'Berhasil mengubah test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengubah test');
        }
    }

    /**
     * @kegunaan
     * Melakukan delete test ginjal
     */
    public function deleteGinjalTest(Test $test)
    {
        DB::beginTransaction();
        try {
            $test->delete();
            DB::commit();
            return redirect()->route('dosen.test.ginjal')->with('success', 'Berhasil menghapus test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus test');
        }
    }

    /**
     * @kegunaan
     * Melakukan update status test ginjal
     */
    public function updateStatusGinjalTest(Test $test)
    {
        DB::beginTransaction();
        try {
            $test->status = $test->status == 'draft' ? 'published' : 'draft';
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.ginjal')->with('success', 'Berhasil mengubah status test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengubah status test');
        }
    }

    /**
     * @kegunaan
     * Melakukan store soal test ginjal
     */
    public function storeGinjalSoal(Request $request, Test $test)
    {
        // check if test is essay or not
        if ($request->type == 'essay') {
            $request->validate([
                'question' => 'required',
                'score' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question = new Question;
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->score = $request->score;
                $question->type = 'essay';
                $question->test_id = $test->id;
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.ginjal.soal', $test->slug)->with('success', 'Berhasil menambahkan soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal menambahkan soal');
            }
        } else {
            $request->validate([
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'option_e' => 'nullable',
                'score' => 'required',
                'correct_answer' => 'required',
                'type' => 'multiple_choice',
            ]);

            DB::beginTransaction();
            try {
                $question = new Question;
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->option_a = $request->option_a;
                $question->option_b = $request->option_b;
                $question->option_c = $request->option_c;
                $question->option_d = $request->option_d;
                $question->option_e = $request->option_e;
                $question->score = $request->score;
                $question->correct_answer = $request->correct_answer;
                $question->type = 'multiple_choice';
                $question->test_id = $test->id;
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.ginjal.soal', $test->slug)->with('success', 'Berhasil menambahkan soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal menambahkan soal');
            }
        }
    }

    /**
     * @kegunaan
     * Melakukan update soal test ginjal
     */
    public function updateGinjalSoal(Request $request, Test $test, Question $question)
    {
        // check if test is essay or not
        if ($request->type == 'essay') {
            $request->validate([
                'question' => 'required',
                'score' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->score = $request->score;
                $question->correct_answer = null;
                $question->type = 'essay';
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.ginjal.soal', $test->slug)->with('success', 'Berhasil mengubah soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal mengubah soal');
            }
        } else {
            $request->validate([
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'option_e' => 'nullable',
                'score' => 'required',
                'correct_answer' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->option_a = $request->option_a;
                $question->option_b = $request->option_b;
                $question->option_c = $request->option_c;
                $question->option_d = $request->option_d;
                $question->option_e = $request->option_e;
                $question->score = $request->score;
                $question->correct_answer = $request->correct_answer;
                $question->type = 'multiple_choice';
                $question->test_id = $test->id;
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.ginjal.soal', $test->slug)->with('success', 'Berhasil mengubah soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal mengubah soal');
            }
        }
    }

    /**
     * @kegunaan
     * Melakukan delete soal test ginjal
     */
    public function deleteGinjalSoal(Test $test, Question $question)
    {
        DB::beginTransaction();
        try {
            $question->delete();
            DB::commit();
            return redirect()->route('dosen.test.ginjal.soal', $test->slug)->with('success', 'Berhasil menghapus soal');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus soal');
        }
    }

    // ==================== REPRODUKSI ====================

    /**
     * @kegunaan
     * Melakukan store test reproduksi
     */
    public function storeReproduksiTest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'passing_score' => 'required',
            'duration' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $test = new Test;
            $test->slug = self::slug($request->name);
            $test->name = $request->name;
            $test->description = $request->description;
            $test->category = 'reproduksi';
            $test->passing_score = $request->passing_score;
            $test->duration = $request->duration;
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.reproduksi')->with('success', 'Berhasil menambahkan test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan test');
        }
    }

    /**
     * @kegunaan
     * Melakukan update test reproduksi
     */
    public function updateReproduksiTest(Request $request, Test $test)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'passing_score' => 'required',
            'duration' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $test->slug = self::slug($request->name);
            $test->name = $request->name;
            $test->description = $request->description;
            $test->category = 'reproduksi';
            $test->passing_score = $request->passing_score;
            $test->duration = $request->duration;
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.reproduksi')->with('success', 'Berhasil mengubah test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengubah test');
        }
    }

    /**
     * @kegunaan
     * Melakukan delete test reproduksi
     */
    public function deleteReproduksiTest(Test $test)
    {
        DB::beginTransaction();
        try {
            $test->delete();
            DB::commit();
            return redirect()->route('dosen.test.reproduksi')->with('success', 'Berhasil menghapus test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus test');
        }
    }

    /**
     * @kegunaan
     * Melakukan update status test reproduksi
     */
    public function updateStatusReproduksiTest(Test $test)
    {
        DB::beginTransaction();
        try {
            $test->status = $test->status == 'draft' ? 'published' : 'draft';
            $test->save();
            DB::commit();
            return redirect()->route('dosen.test.reproduksi')->with('success', 'Berhasil mengubah status test');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengubah status test');
        }
    }

    /**
     * @kegunaan
     * Melakukan store soal test reproduksi
     */
    public function storeReproduksiSoal(Request $request, Test $test)
    {
        // check if test is essay or not
        if ($request->type == 'essay') {
            $request->validate([
                'question' => 'required',
                'score' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question = new Question;
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->score = $request->score;
                $question->type = 'essay';
                $question->test_id = $test->id;
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.reproduksi.soal', $test->slug)->with('success', 'Berhasil menambahkan soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal menambahkan soal');
            }
        } else {
            $request->validate([
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'option_e' => 'nullable',
                'score' => 'required',
                'correct_answer' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question = new Question;
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->option_a = $request->option_a;
                $question->option_b = $request->option_b;
                $question->option_c = $request->option_c;
                $question->option_d = $request->option_d;
                $question->option_e = $request->option_e;
                $question->score = $request->score;
                $question->correct_answer = $request->correct_answer;
                $question->type = 'multiple_choice';
                $question->test_id = $test->id;
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.reproduksi.soal', $test->slug)->with('success', 'Berhasil menambahkan soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal menambahkan soal');
            }
        }
    }

    /**
     * @kegunaan
     * Melakukan update soal test reproduksi
     */
    public function updateReproduksiSoal(Request $request, Test $test, Question $question)
    {
        // check if test is essay or not
        if ($request->type == 'essay') {
            $request->validate([
                'question' => 'required',
                'score' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->score = $request->score;
                $question->correct_answer = null;
                $question->type = 'essay';
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.reproduksi.soal', $test->slug)->with('success', 'Berhasil mengubah soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal mengubah soal');
            }
        } else {
            $request->validate([
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'option_e' => 'nullable',
                'score' => 'required',
                'correct_answer' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $question->slug = self::slug($request->question);
                $question->question = $request->question;
                $question->option_a = $request->option_a;
                $question->option_b = $request->option_b;
                $question->option_c = $request->option_c;
                $question->option_d = $request->option_d;
                $question->option_e = $request->option_e;
                $question->score = $request->score;
                $question->correct_answer = $request->correct_answer;
                $question->type = 'multiple_choice';
                $question->test_id = $test->id;
                $question->save();
                DB::commit();
                return redirect()->route('dosen.test.reproduksi.soal', $test->slug)->with('success', 'Berhasil mengubah soal');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal mengubah soal');
            }
        }
    }

    /**
     * @kegunaan
     * Melakukan delete soal test reproduksi
     */
    public function deleteReproduksiSoal(Test $test, Question $question)
    {
        DB::beginTransaction();
        try {
            $question->delete();
            DB::commit();
            return redirect()->route('dosen.test.reproduksi.soal', $test->slug)->with('success', 'Berhasil menghapus soal');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus soal');
        }
    }

    /**
     * @kegunaan
     * Melakukan sluging berdasarkan waktu di buat dengan timestamp
     */
    private function slug($name)
    {
        $slug = Str::slug($name . '-' . time());
        return $slug;
    }
}
