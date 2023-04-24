@extends('layouts.app')

@section('content')
    <div class="container pt-20">

        <h3 class="text-center font-bold text-2xl mb-5">Test {{ $jenis }}</h3>
        <div class="container dark:bg-slate-800 rounded shadow-md p-10 mb-20 bg-white">
            <div class="flex flex-row justify-center sm:justify-end mb-5">
                <a href="{{ $route_create }}">
                    <button class="button">
                        Buat Test
                    </button>
                </a>
            </div>
            <livewire:test-table />
        </div>
    </div>
@endsection
