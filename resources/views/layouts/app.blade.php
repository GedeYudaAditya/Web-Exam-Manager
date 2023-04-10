<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WEM ::. {{ $title }}</title>
    {{-- icon --}}
    <link rel="icon" href="/images/logo.png" type="image/x-icon">
    {{-- font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="background h-full">
        <header class="w-full flex flex-row justify-between p-5 fixed">
            <div class="logo">
                <a href="/">
                    <img class="w-12" src="/images/logo.png" alt="Logo">
                </a>
            </div>

            <nav class="w-max flex">
                <ul class="w-80 flex items-center flex-row justify-around text-sm font-bold">
                    <li
                        class="link-nav {{ Route::is('landing-page') || Route::is('mahasiswa.index') || Route::is('dosen.index') ? 'link-nav-active' : '' }}">
                        <a href="/">Dashboard</a>
                    </li>
                    @if (Auth::check())
                        @if (Auth::user()->role == 'mahasiswa')
                            <li class="link-nav {{ Route::is('mahasiswa.media') ? 'link-nav-active' : '' }}"><a
                                    href="/about">Media</a></li>
                            <li class="link-nav {{ Route::is('mahasiswa.page') ? 'link-nav-active' : '' }}"><a
                                    href="/contact">Test</a></li>
                        @elseif(Auth::user()->role == 'dosen')
                            <li class=" text-center link-nav {{ Route::is('dosen.media') ? 'link-nav-active' : '' }}"><a
                                    href="/about">M.Media</a></li>
                            <li class=" text-center link-nav {{ Route::is('dosen.page') ? 'link-nav-active' : '' }}"><a
                                    href="/contact">M.Test</a></li>
                        @endif
                    @else
                        <li class="link-nav {{ Route::is('about') ? 'link-nav-active' : '' }}"><a
                                href="/">About</a></li>
                        <li class="link-nav {{ Route::is('contact') ? 'link-nav-active' : '' }}"><a
                                href="/">Contact</a></li>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <li class="dropdown-nav">
                            <img class="w-8 rounded-full avatar" src="/images/default.png" alt="Avatar">
                            <ul class="dropdown-content">

                                @if (Auth::check())
                                    <li class="dropdown-item"><a href="/profile">Profile</a></li>
                                    <button type="submit" class="dropdown-item">Logout</button>
                                @else
                                    <button type="button" target-modal="login" id="target-modal"
                                        class="dropdown-item">Login</button>
                                @endif
                            </ul>
                        </li>
                    </form>
                </ul>
            </nav>
        </header>

        <main class="w-full h-screen flex flex-row justify-center items-center">
            <div class="w-3/4">
                @yield('content')
            </div>
        </main>
    </div>
    @vite('resources/js/app.js')
    <script>
        // dropdown-nav
        const dropdownNav = document.querySelectorAll('.dropdown-nav');
        const dropdownContent = document.querySelectorAll('.dropdown-content');
        const dropdownItem = document.querySelectorAll('.dropdown-item');
        const images = document.querySelectorAll('.avatar');

        // jika dropdown-nav diklik maka dropdown-content akan muncul jika di kelik di luar dropdown-content maka akan hilang
        dropdownNav.forEach((nav) => {
            nav.addEventListener('click', () => {
                dropdownContent.forEach((content) => {
                    content.classList.toggle('dropdown-content-active');
                });
            });
        });

        // jika diluar dropdown-nav maka dropdown-content akan hilang
        document.addEventListener('click', (e) => {
            console.log(e.target);
            if (e.target !== images[0]) {
                dropdownContent.forEach((content) => {
                    content.classList.remove('dropdown-content-active');
                });
            }
        });
    </script>
</body>

</html>
