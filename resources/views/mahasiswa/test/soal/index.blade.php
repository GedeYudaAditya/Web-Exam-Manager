@extends('layouts.app')

@section('content')
    <div class="container pt-20">

        {{-- countdown timer --}}
        <div class="flex flex-row justify-center mb-5 fixed top-0 right-0 left-0 z-[9999]">
            <div class="flex flex-col items-center">
                <h3 class="font-bold text-2xl">Waktu Tersisa</h3>
                <div class="flex flex-row items-center">
                    <h1 class="font-bold text-5xl" id="countdown">00:00</h1>
                </div>
            </div>
        </div>

        <h3 class="text-center font-bold text-2xl mb-5">Soal Test {{ $jenis }} | {{ $test->name }}</h3>
        <div class="container dark:bg-slate-800 rounded shadow-md p-10 mb-20 bg-white">
            <div class="flex flex-row justify-center sm:justify-between mb-5">
                {{-- detail test --}}
                <p class="text-white">
                    Durasi : {{ $test->duration }} menit |
                    Banyak Soal : {{ $soals->count() }}
                </p>
            </div>
            <form action="{{ route('mahasiswa.test.makeAttamp', $test->slug) }}" method="POST" id="form">
                @csrf
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
                                        <input type="radio" name="{{ $soal->slug }}" class="null" class="mr-2"
                                            value="" hidden>
                                        <table>
                                            <tr>
                                                <td class="flex flex-row items-start">
                                                    <h4 class="font-bold">
                                                        {{-- Radio --}}
                                                        <input type="radio" name="{{ $soal->slug }}" id=""
                                                            class="mr-2" value="a">
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
                                                        <input type="radio" name="{{ $soal->slug }}" id=""
                                                            class="mr-2" value="b">
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
                                                        <input type="radio" name="{{ $soal->slug }}" id=""
                                                            class="mr-2" value="c">
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
                                                        <input type="radio" name="{{ $soal->slug }}" id=""
                                                            class="mr-2" value="d">
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
                                                            <input type="radio" name="{{ $soal->slug }}" id=""
                                                                class="mr-2" value="e">
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
                                        <textarea name="{{ $soal->slug }}" id="" rows="10" class="w-full text-black p-5"></textarea>
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
                    {{-- Tombol Submit --}}
                    <button id="sub" type="button" class="button-info ml-3">
                        Submit
                    </button>
                    <button hidden id="submit" type="submit" class="button-info ml-3"></button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('other_js')
    <script>
        // Timer
        var timeleft = {{ $test->duration }} * 60;
        var downloadTimer = setInterval(function() {
            if (timeleft <= 0) {
                window.onbeforeunload = null;
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "Waktu Habis";
                document.getElementById("submit").click();
            } else {
                // tampilkan waktu di countdown dengan format menit:detik (00:00)
                var minutes = Math.floor(timeleft / 60);
                var seconds = timeleft - minutes * 60;

                if (seconds < 10) {
                    seconds = "0" + seconds;
                }

                if (minutes < 10) {
                    minutes = "0" + minutes;
                }

                document.getElementById("countdown").innerHTML = minutes + ":" + seconds;
            }
            timeleft -= 1;
        }, 1000);

        // if user click submit button, allow user to leave the page
        var radios = document.getElementsByTagName('input');
        var notAnswered = false;
        document.getElementById("sub").addEventListener("click", function() {
            window.onbeforeunload = null;

            // if there is still question not answered warning the user

            for (var i = 0; i < radios.length; i++) {
                if (radios[i].type === 'radio' && radios[i].checked === false) {
                    notAnswered = true;
                }
            }

            if (notAnswered) {
                if (confirm("Masih ada soal yang belum dijawab, yakin ingin submit?")) {
                    // get element radio with class null
                    var nulls = document.getElementsByClassName('null');
                    // check all radios
                    for (var i = 0; i < nulls.length; i++) {
                        nulls[i].checked = true;
                    }

                    document.getElementById("submit").click();
                }
            }
        });

        // do not allow user refresh page
        window.onbeforeunload = function() {
            return "Data will be lost if you leave the page, are you sure?";
        };

        // do not allow user back to previous page from browser
        history.pushState(null, null, location.href);
    </script>
@endsection
