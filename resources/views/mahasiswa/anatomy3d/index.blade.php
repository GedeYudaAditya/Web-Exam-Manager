@extends('layouts.app')

@section('content')
    <div class="container mt-20 mb-10">
        <h3 class="text-center font-bold text-2xl mb-5">Pilih Anatomy 3D</h3>
        {{-- row with 3 col --}}
        <div class="grid grid-cols-3 gap-10">
            <a
                href="https://sketchfab.com/models/2983eca6847842aaa357864736e168f6/embed?autostart=1&annotations_visible=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Paru.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Paru-Paru 1</h3>
                    </div>
                </div>
            </a>
            <a
                href="https://sketchfab.com/models/98eae0ffe58a4e63b8d52c23813b3aaf/embed?autostart=1&annotations_visible=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Paru.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Prau-Paru 2</h3>
                    </div>

                </div>
            </a>
            <a href="https://sketchfab.com/models/6299e58c80ce41e7ae2a064c3ed2754e/embed?autostart=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Paru.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Prau-Paru 3</h3>
                    </div>

                </div>
            </a>

            <a href="https://sketchfab.com/models/d8c0652ddff4474585ccba155c490622/embed?autostart=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Ginjal.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Ginjal 1</h3>
                    </div>
                </div>
            </a>
            <a
                href="https://sketchfab.com/models/78b5f854f82b4deb83c84b986d404572/embed?autostart=1&annotations_visible=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Ginjal.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Ginjal 2</h3>
                    </div>

                </div>
            </a>
            <a
                href="https://sketchfab.com/models/bc29d18d06394bde8cce92488f976ecd/embed?autostart=1&annotations_visible=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Ginjal.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Ginjal 3</h3>
                    </div>

                </div>
            </a>

            <a
                href="https://sketchfab.com/models/bcf270c3b423442382c357c25685d808/embed?autostart=1&annotations_visible=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Reproduksi.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Reproduksi Wanita 1</h3>
                    </div>
                </div>
            </a>
            <a
                href="https://sketchfab.com/models/b6d267fcf4464a028e37f9289f512d3d/embed?autostart=1&annotations_visible=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Reproduksi.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Reproduksi Wanita 2</h3>
                    </div>

                </div>
            </a>
            <a
                href="https://sketchfab.com/models/47d6f27638904c108e4f1f0782b6549f/embed?autostart=1&annotations_visible=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Reproduksi.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Reproduksi Wanita 3</h3>
                    </div>

                </div>
            </a>

            <a href="https://sketchfab.com/models/9b0b079953b840bc9a13f524b60041e4/embed?autostart=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Anatomi.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Full Body 1</h3>
                    </div>
                </div>
            </a>
            <a href="https://sketchfab.com/models/95b63a1733ec4d46923aea155d39fc84/embed?autostart=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Anatomi.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Full Body 2</h3>
                    </div>

                </div>
            </a>
            <a href="https://sketchfab.com/models/6a7a537a71444f6e8201e18a685a013d/embed?autostart=1&ui_theme=dark">
                <div
                    class="bg-white rounded group shadow-md hover:bg-blue-500 hover:text-white transition-all ease-in-out overflow-hidden">
                    <img class="w-full h-52 object-cover rounded-t group-hover:scale-110 transition-all ease-in-out"
                        src="{{ asset('images/Anatomi.png') }}" alt="">
                    <div class="card-body p-3">
                        <h3 class="text-center font-bold">Model Full Body 3</h3>
                    </div>

                </div>
            </a>
        </div>
    </div>
@endsection
