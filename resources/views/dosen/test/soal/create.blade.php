@extends('layouts.app')

@section('content')
    <div class="container pt-20">
        <h3 class="text-center font-bold text-2xl mb-5">Buat Soal Untuk Test {{ $test->name }}</h3>
        <div class="container dark:bg-slate-800 rounded shadow-md p-10 mb-20 bg-white">
            <form action="{{ $route_store }}" method="POST">
                @csrf
                <p class="block font-bold text-white mb-5">
                    <span class="text-red-500">*</span> Wajib diisi
                </p>
                <div class="flex flex-col mb-5">
                    <label for="question" class="font-bold text-white">Pertanyaan <span class="text-red-500">*</span></label>
                    <textarea name="question" id="question" class="border border-gray-300 rounded p-2"></textarea>
                </div>

                {{-- Jenis Pertanyaan --}}
                <div class="flex flex-col mb-5">
                    <label for="question_type" class="font-bold text-white">Jenis Pertanyaan <span
                            class="text-red-500">*</span></label>
                    <select name="type" id="question_type" class="border border-gray-300 rounded p-2" required>
                        <option selected disabled>-- Pilih Jenis Soal --</option>
                        <option value="multiple_choice">Pilihan Ganda</option>
                        <option value="essay">Essay</option>
                    </select>
                </div>

                <div id="multiple_choice">
                    <p class="font-bold text-white mb-3">
                        Pilihan Jawaban:
                    </p>
                    <div class="flex flex-row justify-between mb-5">
                        <div class="flex flex-col mb-5">
                            <label for="option_a" class="font-bold text-white">Pilihan A <span
                                    class="text-red-500">*</span></label>
                            <textarea type="text" name="option_a" id="option_a" rows="6" class="border border-gray-300 rounded p-2"></textarea>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="option_b" class="font-bold text-white">Pilihan B <span
                                    class="text-red-500">*</span></label>
                            <textarea type="text" name="option_b" id="option_b" rows="6" class="border border-gray-300 rounded p-2"></textarea>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="option_c" class="font-bold text-white">Pilihan C <span
                                    class="text-red-500">*</span></label>
                            <textarea type="text" name="option_c" id="option_c" rows="6" class="border border-gray-300 rounded p-2"></textarea>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="option_d" class="font-bold text-white">Pilihan D <span
                                    class="text-red-500">*</span></label>
                            <textarea type="text" name="option_d" id="option_d" rows="6" class="border border-gray-300 rounded p-2"></textarea>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="option_e" class="font-bold text-white">Pilihan E</label>
                            <textarea type="text" name="option_e" id="option_e" rows="6" class="border border-gray-300 rounded p-2"></textarea>
                        </div>
                    </div>
                    <div class="flex flex-col mb-5">
                        <label for="answer" class="font-bold text-white">Jawaban <span
                                class="text-red-500">*</span></label>
                        <select name="correct_answer" id="answer" class="border border-gray-300 rounded p-2">
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col mb-5">
                    <label for="score" class="font-bold text-white">Score <span class="text-red-500">*</span></label>
                    <input type="number" name="score" id="score" class="border border-gray-300 rounded p-2">
                </div>
                <div class="flex flex-row justify-center sm:justify-end mb-5">
                    <button type="submit" class="button me-5">
                        Simpan
                    </button>
                    <a href="{{ $route_back }}">
                        <button type="button" class="button-secondary">
                            Batal
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('other_js')
    {{-- Buat elemen id multiple_choice hilang keteika user memilih essay pada element id question_type --}}
    <script>
        $(document).ready(function() {
            $('#multiple_choice').hide();
            $('#question_type').change(function() {
                if ($('#question_type').val() == 'multiple_choice') {
                    $('#multiple_choice').show();
                } else {
                    $('#multiple_choice').hide();
                }
            });
        });
    </script>
@endsection
