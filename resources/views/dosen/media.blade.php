@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h-screen pt-24">
            <h3 class="text-center font-bold text-2xl mb-5">Pilih Media Pembelajaran</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('dosen.media') }}">
                    <div
                        class="bg-slate-300 p-10 rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out">
                        <div class="grid grid-cols-2 gap-4 justify-center items-center">
                            <img src="{{ asset('images/video.png') }}" alt="video"
                                class="group-hover:translate-x-7 group-hover:-translate-y-7 group-hover:rotate-6 transition-all ease-in-out">
                            <h4
                                class="text-center font-bold text-2xl mb-5 group-hover:scale-125 group-hover:translate-x-7 transition-all ease-in-out">
                                VIDEO</h4>
                        </div>
                    </div>
                </a>
                <a href="{{ route('dosen.media.anatomy3d') }}">
                    <div
                        class="bg-slate-300 p-10 rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out">
                        <div class="grid grid-cols-2 gap-4 justify-center items-center">
                            <img src="{{ asset('images/3d-model-icon.webp') }}" alt="anatomy 3d"
                                class="group-hover:translate-x-7 group-hover:-translate-y-7 group-hover:rotate-6 transition-all ease-in-out">
                            <h4
                                class="text-center font-bold text-2xl mb-5 group-hover:scale-125 group-hover:translate-x-7 transition-all ease-in-out">
                                ANATOMY 3D</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
