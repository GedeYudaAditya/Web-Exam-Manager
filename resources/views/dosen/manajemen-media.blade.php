@extends('layouts.app')

@section('content')
    <div class="container mt-20">
        <h3 class="text-center font-bold text-2xl mb-5">List Video Pembelajaran</h3>

        <div class="container rounded shadow-md p-10 mb-10 bg-white">

            <div class="container flex flex-row justify-end">
                <a href="#" class="button">+ Tambah Media Video</a>
            </div>

            <a href="{{ route('mahasiswa.media.video.detail', 'code') }}"
                class="flex flex-row my-5 p-3 border-y hover:bg-blue-500 hover:text-white">
                <div class="basis-1/4 mr-5">
                    <img src="{{ asset('/images/video_thumbnail.png') }}" alt="">
                </div>
                <div class="basis-3/4">
                    <h4 class="font-bold text-lg">Judul Video</h4>
                    <hr>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae odit qui fugiat rem placeat, in nisi
                        officiis harum repudiandae accusamus? Soluta magnam eius obcaecati. Molestias omnis recusandae
                        aliquid ipsam tempora?</p>
                </div>
            </a>
            <a href="{{ route('mahasiswa.media.video.detail', 'code') }}"
                class="flex flex-row my-5 p-3 border-y hover:bg-blue-500 hover:text-white">
                <div class="basis-1/4 mr-5">
                    <img src="{{ asset('/images/video_thumbnail.png') }}" alt="">
                </div>
                <div class="basis-3/4">
                    <h4 class="font-bold text-lg">Judul Video</h4>
                    <hr>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae odit qui fugiat rem placeat, in nisi
                        officiis harum repudiandae accusamus? Soluta magnam eius obcaecati. Molestias omnis recusandae
                        aliquid ipsam tempora?</p>
                </div>
            </a>
            <a href="{{ route('mahasiswa.media.video.detail', 'code') }}"
                class="flex flex-row my-5 p-3 border-y hover:bg-blue-500 hover:text-white">
                <div class="basis-1/4 mr-5">
                    <img src="{{ asset('/images/video_thumbnail.png') }}" alt="">
                </div>
                <div class="basis-3/4">
                    <h4 class="font-bold text-lg">Judul Video</h4>
                    <hr>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae odit qui fugiat rem placeat, in nisi
                        officiis harum repudiandae accusamus? Soluta magnam eius obcaecati. Molestias omnis recusandae
                        aliquid ipsam tempora?</p>
                </div>
            </a>
        </div>
    </div>
@endsection
