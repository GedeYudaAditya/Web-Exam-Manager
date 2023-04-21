@extends('layouts.app')

@section('content')
    <div class="flex flex-col-reverse sm:flex-row items-center h-screen">
        <div class="container">
            <h1 class="text-center font-bold text-4xl mb-5 sm:mb-10 sm:text-start">Anatomi Fisiologi <br> Manusia</h1>
            {{-- Button Mulai --}}
            <div class="flex flex-row justify-center sm:justify-normal">
                <a href="/test">
                    <button class="button">
                        Mulai Belajar
                    </button>
                </a>
            </div>
        </div>
        <div class="container">
            {{-- <img width="600" src="{{ asset('images/test.png') }}" alt=""> --}}
            <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_ikvz7qhc.json" background="transparent"
                speed="1" class="img-fluid w-100 px-lg-5" class="w-full" loop autoplay>
            </lottie-player>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        </div>
    </div>

    <script>
        Swal.fire({
            title: 'Selamat Datang {{ auth()->user()->name }}!',
            text: "{{ $content }}",
            icon: 'info',
            confirmButtonText: 'Oke'
        })
    </script>
@endsection
