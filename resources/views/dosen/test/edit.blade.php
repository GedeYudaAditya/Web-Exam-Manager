@extends('layouts.app')

@section('content')
    <div class="container pt-20">

        <h3 class="text-center font-bold text-2xl mb-5">Edit Test {{ $jenis }}</h3>
        <div class="container dark:bg-slate-800 rounded shadow-md p-10 mb-20 bg-white">
            {{-- show all error validation --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">Ada kesalahan dalam pengisian form</span>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $route_update }}" method="POST">
                {{-- input nama, description, duration, dan passing_score --}}
                @csrf
                <p class="block font-bold text-white mb-5">
                    <span class="text-red-500">*</span> Wajib diisi
                </p>
                <div class="mb-5">
                    <label for="nama" class="block mb-2 font-bold text-xl text-white">Nama Test <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="nama" placeholder="Nama Test" value="{{ $test->name }}"
                        class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300">
                </div>
                <div class="mb-5">
                    <label for="description" class="block mb-2 font-bold text-xl text-white">Deskripsi</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300">{{ $test->description }}</textarea>
                </div>
                <div class="mb-5">
                    <label for="passing_score" class="block mb-2 font-bold text-xl text-white">Passing Score <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="passing_score" id="passing_score" placeholder="Passing Score"
                        value="{{ $test->passing_score }}"
                        class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300">
                </div>
                <div class="mb-5">
                    <label for="duration" class="block mb-2 font-bold text-xl text-white">Durasi <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="duration" id="duration" placeholder="Durasi (menit)"
                        value="{{ $test->duration }}"
                        class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300">
                </div>
                <div class="flex flex-row justify-center sm:justify-end mb-5">
                    <button type="submit" class="button me-5">
                        Edit Test
                    </button>
                    {{-- tombol batal --}}
                    <a href="{{ $route_back }}">
                        <button type="button" class="button-secondary">
                            Batal
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
