@extends('layouts.app')

@section('content')
    <div class="flex flex-col-reverse sm:flex-row items-center h-screen">
        <div class="container">
            <h1 class="text-center font-bold text-4xl mb-5 sm:mb-10 sm:text-start">Anatomi Fisiologi <br> Manusia</h1>
            {{-- Button Mulai --}}
            <div class="flex flex-row justify-center sm:justify-normal">
                {{-- Button modal --}}
                <button class="button" target-modal="login" id="target-modal">
                    Mulai
                </button>
            </div>
        </div>
        <div class="container">
            {{-- <img width="600" src="{{ asset('images/test.png') }}" alt=""> --}}
            <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_ikvz7qhc.json" background="transparent"
                speed="1" class="img-fluid w-100 px-lg-5" class="w-full" loop autoplay>
            </lottie-player>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        </div>
    </div>

    {{-- Modal
    <div class="modal modal-login hidden" id="login">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-2xl font-bold">Login</h2>
                <button class="close-modal" data-modal="login">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" autocomplete="email"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md h-7 px-3">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" autocomplete="current-password"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md h-7 px-3">
                        </div>
                    </div>
                    <div class="flex flex-row gap-4 justify-center">
                        <button type="submit" target-modal="register" id="target-modal"
                            class="button bg-blue-500 hover:bg-blue-600 focus:ring-blue-500 focus:ring-offset-blue-200 active:bg-blue-600 transition ease-in-out duration-150">
                            Login
                        </button>
                        <button type="button" target-modal="register" id="target-modal"
                            class="button-secondary bg-slate-700 hover:bg-slate-400 transition ease-in-out duration-150">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-register hidden" id="register">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-2xl font-bold">Login</h2>
                <button class="close-modal-2" data-modal="register">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" autocomplete="name"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md h-7 px-3">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" autocomplete="email"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md h-7 px-3">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" autocomplete="current-password"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md h-7 px-3">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                            Password</label>
                        <div class="mt-1">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                autocomplete="current-password"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md h-7 px-3">
                        </div>
                    </div>
                    <div class="flex flex-row justify-center">
                        <button type="submit"
                            class="button bg-blue-500 hover:bg-blue-600 focus:ring-blue-500 focus:ring-offset-blue-200 active:bg-blue-600 transition ease-in-out duration-150">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    @include('modal_auth')

    @php
        $error = $errors->all();
    @endphp

    @if ($error)
        <script>
            Swal.fire({
                title: 'Gagal!',
                html: " @foreach ($error as $item)" +
                    "[{{ $item }}] <br>" +
                    "@endforeach",
                icon: 'warning',
                confirmButtonText: 'Oke'
            })
        </script>
    @else
        <script>
            Swal.fire({
                title: 'Selamat Datang!',
                text: "{{ $content }}",
                icon: 'info',
                confirmButtonText: 'Oke'
            })
        </script>
    @endif

    {{-- @if (session()->has('error'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: "{{ session()->get('error') }}",
                icon: 'warning',
                confirmButtonText: 'Oke'
            })
        </script>
    @elseif(session()->has('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session()->get('success') }}",
                icon: 'success',
                confirmButtonText: 'Oke'
            })
        </script>
    @endif --}}

    {{-- Script Modal --}}
    <script>
        const modal = document.querySelectorAll('.modal-login');
        const modalBtn = document.querySelectorAll('#target-modal');
        const closeBtn = document.querySelectorAll('.close-modal');

        modalBtn.forEach((btn) => {
            btn.addEventListener('click', () => {
                modal.forEach((modal) => {
                    if (btn.getAttribute('target-modal') == modal.getAttribute('id')) {
                        // toggle modal
                        modal.classList.toggle('hidden');
                        modal.classList.toggle('flex');
                    }
                });
            });
        });

        closeBtn.forEach((btn) => {
            btn.addEventListener('click', () => {
                modal.forEach((modal) => {
                    if (btn.getAttribute('data-modal') == modal.getAttribute('id')) {
                        // toggle modal
                        modal.classList.toggle('hidden');
                        modal.classList.toggle('flex');
                    }
                });
            });
        });

        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-login')) {
                modal.forEach((modal) => {
                    modal.classList.toggle('hidden');
                    modal.classList.toggle('flex');
                });
            }
        });
    </script>

    <script>
        const modalRegister = document.querySelectorAll('.modal-register');
        const modalBtnRegister = document.querySelectorAll('.button-secondary');
        const closeBtnRegister = document.querySelectorAll('.close-modal-2');

        modalBtnRegister.forEach((btn) => {
            btn.addEventListener('click', () => {
                modalRegister.forEach((modal) => {
                    if (btn.getAttribute('target-modal') == modal.getAttribute('id')) {
                        // toggle modal
                        modal.classList.toggle('hidden');
                        modal.classList.toggle('flex');
                    }
                });
            });
        });

        closeBtnRegister.forEach((btn) => {
            btn.addEventListener('click', () => {
                modalRegister.forEach((modal) => {
                    if (btn.getAttribute('data-modal') == modal.getAttribute('id')) {
                        // toggle modal
                        modal.classList.toggle('hidden');
                        modal.classList.toggle('flex');
                    }
                });
            });
        });

        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-register')) {
                modalRegister.forEach((modal) => {
                    modal.classList.toggle('hidden');
                    modal.classList.toggle('flex');
                });
            }
        });
    </script>
@endsection
