<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Drive</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="background h-screen">
        <header class="w-full flex flex-row justify-between p-5">
            <div class="logo">
                <a href="/">
                    <img class="w-12" src="/images/logo.png" alt="Logo">
                </a>
            </div>

            <nav class="w-max flex">
                <ul class="w-80 flex items-center flex-row justify-around text-sm font-bold">
                    <li class="link-nav link-nav-active"><a href="/">Dashboard</a></li>
                    <li class="link-nav"><a href="/about">Media</a></li>
                    <li class="link-nav"><a href="/contact">Test</a></li>
                    <li>
                        <a href="/account">
                            <img class="w-8 rounded-full" src="/images/default.png" alt="Avatar">
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="w-full flex flex-row justify-center">
            <div class="w-3/4">
                @yield('content')
            </div>
        </main>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
