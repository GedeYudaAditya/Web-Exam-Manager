@extends('layouts.app')

@section('content')
    <div class="container pt-20">

        <h3 class="text-center font-bold text-2xl mb-5">Pilih Test</h3>
        <div class="grid grid-cols-3 gap-4 mb-5">
            <a href="{{ route('mahasiswa.test.paru-paru') }}">
                <div
                    class="bg-slate-300 p-10 rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out">
                    <div class="grid grid-cols-2 gap-4 justify-center items-center">
                        <img src="{{ asset('images/3d-model-icon.webp') }}" alt="video"
                            class="group-hover:translate-x-7 group-hover:-translate-y-7 group-hover:rotate-6 transition-all ease-in-out">
                        <h4
                            class="text-center font-bold text-2xl mb-5 group-hover:scale-110 group-hover:translate-x-7 transition-all ease-in-out">
                            Paru-Paru</h4>
                    </div>
                </div>
            </a>
            <a href="{{ route('mahasiswa.test.ginjal') }}">
                <div
                    class="bg-slate-300 p-10 rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out">
                    <div class="grid grid-cols-2 gap-4 justify-center items-center">
                        <img src="{{ asset('images/3d-model-icon.webp') }}" alt="anatomy 3d"
                            class="group-hover:translate-x-7 group-hover:-translate-y-7 group-hover:rotate-6 transition-all ease-in-out">
                        <h4
                            class="text-center font-bold text-2xl mb-5 group-hover:scale-110 group-hover:translate-x-7 transition-all ease-in-out">
                            Ginjal</h4>
                    </div>
                </div>
            </a>
            <a href="{{ route('mahasiswa.test.reproduksi') }}">
                <div
                    class="bg-slate-300 p-10 rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out">
                    <div class="grid grid-cols-2 gap-4 justify-center items-center">
                        <img src="{{ asset('images/3d-model-icon.webp') }}" alt="anatomy 3d"
                            class="group-hover:translate-x-7 group-hover:-translate-y-7 group-hover:rotate-6 transition-all ease-in-out">
                        <h4
                            class="text-center font-bold text-2xl mb-5 group-hover:scale-110 group-hover:translate-x-7 transition-all ease-in-out">
                            Reproduksi Wanita</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
