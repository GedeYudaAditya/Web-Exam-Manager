@extends('layouts.app')

@section('content')
    <div class="flex flex-row mt-16 items-center">
        <div class="container">
            <h1 class="font-bold text-4xl mb-10">Anatomi Fisiologi <br> Manusia</h1>
            {{-- Button Mulai --}}
            <a href="/test">
                <button class="button">
                    Mulai
                </button>
            </a>
        </div>
        <div class="container">
            <img width="600" src="{{ asset('images/test.png') }}" alt="">
        </div>
    </div>
@endsection
