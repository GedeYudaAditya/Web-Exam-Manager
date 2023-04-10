@extends('layouts.app')

@section('content')
    <div class="flex flex-col-reverse sm:flex-row items-center">
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
            <img width="600" src="{{ asset('images/test.png') }}" alt="">
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
