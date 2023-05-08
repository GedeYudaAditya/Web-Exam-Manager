@extends('layouts.app')

@section('content')
    <div class="container h-screen pt-20">
        <h3 class="text-center font-bold text-2xl mb-5">Video Pembelajaran | {{ $video->name }}</h3>

        {{-- <iframe class="w-full h-96 aspect-w-16 aspect-h-9" src="https://www.youtube.com/embed/r9jwGansp1E" frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen></iframe> --}}

        <div class="flex justify-center">
            @php
                $video = $video->embed;
                if (Str::contains($video, 'watch?v=')) {
                    $embed = Str::replaceFirst('watch?v=', 'embed/', $video);
                } else {
                    $embed = Str::replaceFirst('youtu.be/', 'youtube.com/embed/', $video);
                }
            @endphp
            {{-- build good layout for video --}}
            <iframe class="aspect-w-16 aspect-h-9" width="853" height="480" src="{{ $embed }}"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>
    </div>
@endsection
