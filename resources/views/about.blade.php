@extends('layouts.app')

@section('content')
    <div class="2xl:container 2xl:mx-auto lg:py-16 lg:px-20 md:py-12 md:px-6 py-9 px-4">
        {{-- get all error input --}}
        @php
            $error = $errors->all();
        @endphp

        @if (count($error) > 0)
            {{-- give notif --}}
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5 mt-14" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">
                    @foreach ($error as $item)
                        {{ $item }}
                    @endforeach
                </span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg onclick="this.parentElement.parentElement.remove()" class="fill-current h-6 w-6 text-red-500"
                        role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a.5.5 0 010 .707L10.707 10l3.641 3.641a.5.5 0 11-.707.707L10 10.707l-3.641 3.641a.5.5 0 01-.707-.707L9.293 10 5.652 6.359a.5.5 0 01.707-.707L10 9.293l3.641-3.641a.5.5 0 01.707 0z">
                        </path>
                    </svg>
                </span>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row justify-between gap-8">
            <div class="w-full lg:w-5/12 flex flex-col justify-center">
                <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800 pb-4">Tentang Aplikasi</h1>
                <p class="font-normal text-base leading-6 text-gray-600">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt maiores cum consequuntur dicta velit
                    molestias assumenda a aliquam vitae sed eligendi at dolores fugit suscipit, accusantium excepturi rem
                    voluptas tenetur.
                </p>
            </div>
            <div class="w-full lg:w-8/12">
                <img class="w-full h-full" src="https://i.ibb.co/FhgPJt8/Rectangle-116.png" alt="A group of People" />
            </div>
        </div>

        <div class="flex lg:flex-row flex-col justify-between gap-8 pt-12">
            <div class="w-full lg:w-5/12 flex flex-col justify-center">
                <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800 pb-4">Pengembangan</h1>
                <p class="font-normal text-base leading-6 text-gray-600">
                    {{-- Aplikasi ini dikembangkan oleh Marcel Prastiko Arthana, terdiri dari 2 orang dosen pembimbing
                    Universitas Pendidikan Ganesha yaitu Prof. Dr. Ketut Agustini, S.Si, M.Si. dan Dr. phil., Dessy Seri
                    Wahyuni, S.Kom., M.Eng.
                    <br><br> --}}

                    Mahasiswa <br>
                    Nama : Marcel Prastiko Arthana <br>
                    NIM : 1915051013 <br>
                    Prodi : Pendidikan Teknik Informatika <br>
                    <br>

                    Dosen Pembimbing: <br>
                    Dosen Pembimbing 1 <br>
                    Prof. Dr. Ketut Agustini, S.Si, M.Si. <br>
                    NIP. 197408012000032001 <br>
                    <br>

                    Dosen Pembimbing 2 <br>
                    Dr. phil., Dessy Seri Wahyuni, S.Kom., M.Eng. <br>
                    NIP. 198502152008122007 <br>

                </p>
            </div>
            <div class="w-full lg:w-8/12 lg:pt-8">
                <div class="grid md:grid-cols-4 sm:grid-cols-2 grid-cols-1 lg:gap-4 shadow-lg rounded-md">
                    <div class="p-4 pb-6 flex justify-center flex-col items-center">
                        <img class="md:block hidden" src="https://i.ibb.co/FYTKDG6/Rectangle-118-2.png"
                            alt="Alexa featured Image" />
                        <img class="md:hidden block" src="https://i.ibb.co/zHjXqg4/Rectangle-118.png"
                            alt="Alexa featured Image" />
                        <p class="font-medium text-sm leading-5 text-gray-800 mt-4">Marcel Prastiko Arthana <br><br></p>
                    </div>
                    <div class="p-4 pb-6 flex justify-center flex-col items-center">
                        <img class="md:block hidden" src="https://i.ibb.co/fGmxhVy/Rectangle-119.png"
                            alt="Olivia featured Image" />
                        <img class="md:hidden block" src="https://i.ibb.co/NrWKJ1M/Rectangle-119.png"
                            alt="Olivia featured Image" />
                        <p class="font-medium text-sm leading-5 text-gray-800 mt-4">Prof. Dr. Ketut Agustini, S.Si, M.Si.
                        </p>
                    </div>
                    <div class="p-4 pb-6 flex justify-center flex-col items-center">
                        <img class="md:block hidden" src="https://i.ibb.co/Pc6XVVC/Rectangle-120.png"
                            alt="Liam featued Image" />
                        <img class="md:hidden block" src="https://i.ibb.co/C5MMBcs/Rectangle-120.png"
                            alt="Liam featued Image" />
                        <p class="font-medium text-sm leading-5 text-gray-800 mt-4">Dr. phil., Dessy Seri
                            Wahyuni, S.Kom., M.Eng.</p>
                    </div>
                    {{-- <div class="p-4 pb-6 flex justify-center flex-col items-center">
                        <img class="md:block hidden" src="https://i.ibb.co/7nSJPXQ/Rectangle-121.png"
                            alt="Elijah featured image" />
                        <img class="md:hidden block" src="https://i.ibb.co/ThZBWxH/Rectangle-121.png"
                            alt="Elijah featured image" />
                        <p class="font-medium text-xl leading-5 text-gray-800 mt-4">Elijah</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    @include('modal_auth')
@endsection
