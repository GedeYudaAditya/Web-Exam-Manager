@extends('layouts.app')

@section('content')
    <div class="container mt-20">
        <h3 class="text-center font-bold text-2xl mb-5">List Video Pembelajaran</h3>

        <div class="container rounded shadow-md p-10 mb-10 bg-white">
            @forelse ($videos as $video)
                <a href="{{ route('mahasiswa.media.video.detail', $video->slug) }}"
                    class="flex flex-row my-5 p-3 border-y hover:bg-blue-500 hover:text-white">
                    <div class="basis-1/4 mr-5">
                        {{-- get video id --}}
                        @php
                            $videoId = explode('/', $video->embed);
                            $videoId = end($videoId);
                        @endphp
                        <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" alt="">
                    </div>
                    <div class="basis-3/4">
                        <div class="flex flex-row justify-between">
                            <h3 class="font-bold basis-2/4">{{ $video->name }}</h3>
                            <div class="flex flex-row basis-2/4 justify-end">
                                <p>Kategori: {{ $video->category }}</p>
                            </div>
                        </div>
                        <hr>
                        <p>
                            {{ $video->description }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="text-center">Belum ada video</p>
            @endforelse
        </div>
    </div>
@endsection
