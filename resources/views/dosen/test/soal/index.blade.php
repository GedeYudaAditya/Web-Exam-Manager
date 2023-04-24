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
                <a href="{{ $route_create }}">
                    <button class="button">
                        Buat Soal
                    </button>
                </a>
            </div>
            @forelse ($soals as $soal)
                <hr>
                <div class="bg-sky-900 px-2 py-3">
                    <div class="flex items-center flex-col justify-between mb-3 md:flex-row">
                        <a href="{{ route($route_edit, [$test->slug, $soal->slug]) }}">
                            <button class="button mb-3">
                                Edit
                            </button>
                        </a>
                        <div class="flex flex-row mb-3 text-white p-1">
                            <h4 class="font-bold">Score: {{ $soal->score }}</h4>
                        </div>
                        <div class="flex flex-row mb-3 text-white p-1">
                            <h4 class="font-bold">Correct Answer
                                {{ $soal->correct_answer ? Str::upper($soal->correct_answer) : 'Not Included' }}</h4>
                        </div>
                        <form action="{{ route($route_delete, [$test->slug, $soal->slug]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button-danger">
                                Hapus
                            </button>
                        </form>
                    </div>
                    <div class="flex flex-col text-white">
                        <div class="flex flex-row justify-between">
                            <h3 class="font-bold text-xl mb-3">{{ $soal->question }} </h3>
                        </div>
                        <div class="container">
                            <div style="margin-left: 30px; margin-right: 30px;">
                                {{-- bentuk table --}}
                                @if ($soal->type != 'essay')
                                    <table>
                                        <tr>
                                            <td
                                                class="flex flex-row items-start {{ $soal->correct_answer == 'a' ? 'text-green-300' : '' }}">
                                                <h4 class="font-bold">A. </span></h4>
                                            </td>
                                            <td
                                                class="{{ $soal->correct_answer == 'a' ? 'text-green-300 font-bold' : '' }}">
                                                {{ $soal->option_a }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="flex flex-row items-start {{ $soal->correct_answer == 'b' ? 'text-green-300' : '' }}">
                                                <h4 class="font-bold">B. </span></h4>
                                            </td>
                                            <td
                                                class="{{ $soal->correct_answer == 'b' ? 'text-green-300 font-bold' : '' }}">
                                                {{ $soal->option_b }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="flex flex-row items-start {{ $soal->correct_answer == 'c' ? 'text-green-300' : '' }}">
                                                <h4 class="font-bold">C. </span></h4>
                                            </td>
                                            <td
                                                class="{{ $soal->correct_answer == 'c' ? 'text-green-300 font-bold' : '' }}">
                                                {{ $soal->option_c }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="flex flex-row items-start {{ $soal->correct_answer == 'd' ? 'text-green-300' : '' }}">
                                                <h4 class="font-bold">D. </span></h4>
                                            </td>
                                            <td
                                                class="{{ $soal->correct_answer == 'd' ? 'text-green-300 font-bold' : '' }}">
                                                {{ $soal->option_d }}
                                            </td>
                                        </tr>
                                        @if ($soal->option_e)
                                            <tr>
                                                <td
                                                    class="flex flex-row items-start {{ $soal->correct_answer == 'e' ? 'text-green-300' : '' }}">
                                                    <h4 class="font-bold">E. </span></h4>
                                                </td>
                                                <td
                                                    class="{{ $soal->correct_answer == 'e' ? 'text-green-300 font-bold' : '' }}">
                                                    {{ $soal->option_e }}
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                @else
                                    <p>Soal Essay. Jawaban Akan <span class="text-green-300 font-bold">Ditulis</span> Oleh
                                        Peserta</p>
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
