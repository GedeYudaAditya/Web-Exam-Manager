@extends('layouts.app')

@section('content')
    <div class="flex flex-col-reverse sm:flex-row items-center">
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
            <img width="600" src="{{ asset('images/test.png') }}" alt="">
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal hidden" id="login">
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
                    <div class="flex flex-row justify-center">
                        <button type="submit"
                            class="button bg-blue-500 hover:bg-blue-600 focus:ring-blue-500 focus:ring-offset-blue-200 active:bg-blue-600 transition ease-in-out duration-150">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        Swal.fire({
            title: 'Selamat Datang!',
            text: "{{ $content }}",
            icon: 'info',
            confirmButtonText: 'Oke'
        })
    </script>

    @if (session()->has('error'))
        <script>
            Swal.fire({
                title: 'Pastikan akun anda benar!',
                text: "{{ session()->get('error') }}",
                icon: 'warning',
                confirmButtonText: 'Oke'
            })
        </script>
    @endif

    {{-- Script Modal --}}
    <script>
        const modal = document.querySelectorAll('.modal');
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
            if (e.target.classList.contains('modal')) {
                modal.forEach((modal) => {
                    modal.classList.toggle('hidden');
                    modal.classList.toggle('flex');
                });
            }
        });
    </script>
@endsection
