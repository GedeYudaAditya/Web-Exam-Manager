@extends('layouts.app')

@section('content')
    <div class="container mt-20">
        <h3 class="text-center font-bold text-2xl mb-5">List Video Pembelajaran</h3>

        <div class="container rounded shadow-md p-10 mb-10 bg-white">

            <div class="container flex flex-row justify-end">
                <a href="{{ route('dosen.media.create') }}" class="button">+ Tambah Media Video</a>
            </div>

            @forelse ($videos as $video)
                {{-- get video id --}}
                @php
                    $videoId = explode('/', $video->embed);
                    $videoId = end($videoId);
                @endphp
                <div class="flex flex-row my-5 p-3 border-y hover:bg-blue-500 hover:text-white">
                    <a href="{{ route('dosen.media.detail', $video->slug) }}" class="basis-1/4 mr-5">
                        <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" alt="">
                    </a>
                    <div class="basis-3/5">
                        {{-- split into two col --}}
                        <div class="flex flex-row justify-between">
                            <h3 class="font-bold basis-2/4">{{ $video->name }}</h3>
                            {{-- status --}}
                            <div class="flex flex-row basis-2/4">
                                <p class="mr-5">Status:
                                    <a href="{{ route('dosen.media.change-status', $video->slug) }}"
                                        class="font-bold text-white px-2 {{ $video->status == 'published' ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $video->status }}
                                    </a>
                                </p>
                                <p>Kategori: {{ $video->category }}</p>
                            </div>
                        </div>
                        <hr>
                        <p>
                            {{ $video->description }}
                        </p>
                    </div>
                    {{-- edit button --}}
                    <div class="basis-1/5 flex flex-row justify-end gap-1">
                        <a href="{{ route('dosen.media.edit', $video->slug) }}" class="button mb-3 h-fit">
                            Edit
                        </a>
                        <form action="{{ route('dosen.media.delete', $video->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button-danger">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada video</p>
            @endforelse
        </div>
    </div>
@endsection
