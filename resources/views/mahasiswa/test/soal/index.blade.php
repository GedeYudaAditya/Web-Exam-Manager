@extends('layouts.app')

@section('content')
    <div class="container pt-20">

        <h3 class="text-center font-bold text-2xl mb-5">Soal Test {{ $jenis }} | {{ $test->name }}</h3>
        <div class="container dark:bg-slate-800 rounded shadow-md p-10 mb-20 bg-white">
            <div class="flex flex-row justify-center sm:justify-between mb-5">
                {{-- detail test --}}
                <p class="text-white">
                    Durasi : {{ $test->duration }} menit |
                    Banyak Soal : {{ $soals->count() }}
                </p>
            </div>
            @forelse ($soals as $soal)
                <hr>
                <div class="bg-sky-900 px-2 py-3">
                    <div class="flex items-center flex-col justify-between mb-3 md:flex-row">
                        <div class="flex flex-row mb-3 text-white p-1">
                            <h4 class="font-bold">Score: {{ $soal->score }}</h4>
                        </div>
                    </div>
                    <div class="flex flex-col text-white">
                        <div class="flex flex-row justify-between">
                            <h3 class="font-bold text-xl mb-3">{{ $soal->question }} </h3>
                        </div>
                        <div class="container">
                            <div style="margin-left: 30px; margin-right: 30px;">
                                {{-- bentuk table --}}
                                @if ($soal->type != 'essay')
                                    <p>Jawab Soal:</p>
                                    <table>
                                        <tr>
                                            <td class="flex flex-row items-start">
                                                <h4 class="font-bold">
                                                    {{-- Radio --}}
                                                    <input type="radio" name="jawaban" id="" class="mr-2"
                                                        value="a">
                                                    A. </span>
                                                </h4>
                                            </td>
                                            <td>
                                                {{ $soal->option_a }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex flex-row items-start">
                                                <h4 class="font-bold">
                                                    {{-- Radio --}}
                                                    <input type="radio" name="jawaban" id="" class="mr-2"
                                                        value="b">
                                                    B. </span>
                                                </h4>
                                            </td>
                                            <td>
                                                {{ $soal->option_b }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex flex-row items-start">
                                                <h4 class="font-bold">
                                                    {{-- Radio --}}
                                                    <input type="radio" name="jawaban" id="" class="mr-2"
                                                        value="c">
                                                    C. </span>
                                                </h4>
                                            </td>
                                            <td>
                                                {{ $soal->option_c }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="flex flex-row items-start">
                                                <h4 class="font-bold">
                                                    {{-- Radio --}}
                                                    <input type="radio" name="jawaban" id="" class="mr-2"
                                                        value="d">
                                                    D. </span>
                                                </h4>
                                            </td>
                                            <td>
                                                {{ $soal->option_d }}
                                            </td>
                                        </tr>
                                        @if ($soal->option_e)
                                            <tr>
                                                <td class="flex flex-row items-start">
                                                    <h4 class="font-bold">
                                                        {{-- Radio --}}
                                                        <input type="radio" name="jawaban" id="" class="mr-2"
                                                            value="e">
                                                        E. </span>
                                                    </h4>
                                                </td>
                                                <td>
                                                    {{ $soal->option_e }}
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                @else
                                    <p>Jawab Soal: </p>
                                    <textarea name="" id="" rows="10" class="w-full text-black p-5"></textarea>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-5">
            @empty
                <hr class="mb-5">
                <h3 class="text-center text-white">Belum ada soal</h3>
                <hr class="my-5">
            @endforelse
            {{-- back button --}}
            <div class="flex flex-row justify-center">
                <a href="{{ $route_back }}">
                    <button class="button">
                        Kembali
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
