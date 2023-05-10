@extends('layouts.app')

@section('content')
    {{-- Edit Profile Section --}}
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="h-full">

            <div class="border-b-2 block md:flex mt-20 mb-10">
                <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
                    <div class="flex justify-between">
                        <span class="text-xl font-semibold block">Profile</span>
                    </div>

                    <span class="text-gray-600">This information is secret so be careful</span>
                    <div class="w-full p-8 mx-2 flex justify-center">
                        <img id="showImage" class="max-w-xs w-32 items-center border"
                            src="{{ auth()->user()->avatar != 'default.png' ? asset('/storage/avatars/' . auth()->user()->avatar) : asset('/images/' . auth()->user()->avatar) }}"
                            alt="">
                    </div>

                    <div class="pb-4">
                        <label for="avatar" class="font-semibold text-gray-700 block pb-1">Avatar</label>
                        <input id="avatar" class="border-1  rounded-r px-4 py-2 w-full" type="file" value=""
                            accept=".jpg,.jpeg,.png" name="avatar" />
                    </div>
                </div>

                <div class="w-full md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
                    <div class="rounded  shadow p-6">
                        {{-- show error --}}
                        @if ($errors->any())
                            <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                                <ul class="list-disc">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-sm">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="pb-6">
                            <label for="name" class="font-semibold text-gray-700 block pb-1">Name</label>
                            <div class="flex">
                                <input id="username" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    name="name" value="{{ old('name') ?? auth()->user()->name }}" />
                            </div>
                        </div>
                        <div class="pb-4">
                            <label for="about" class="font-semibold text-gray-700 block pb-1">Email</label>
                            <input id="email" class="border-1  rounded-r px-4 py-2 w-full" type="email" name="email"
                                value="{{ old('email') ?? auth()->user()->email }}" />
                        </div>
                        @if (auth()->user()->role != 'dosen')
                            <div class="pb-4">
                                <label for="nim" class="font-semibold text-gray-700 block pb-1">Nim</label>
                                <input id="nim" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    name="nim" value="{{ old('nim') ?? auth()->user()->nim }}" />
                            </div>
                        @endif
                        <div class="pb-4">
                            <label for="password" class="font-semibold text-gray-700 block pb-1">Password</label>
                            <input id="password" class="border-1  rounded-r px-4 py-2 w-full" type="password"
                                name="password" value="" />
                        </div>
                        <div class="pb-4">
                            <label for="password_confirmation" class="font-semibold text-gray-700 block pb-1">Password
                                Confirmation</label>
                            <input id="password_confirmation" class="border-1  rounded-r px-4 py-2 w-full" type="password"
                                name="password_confirmation" value="" />
                            <span class="text-gray-600 pt-4 block opacity-70">Personal login information of your
                                account</span>
                        </div>
                        {{-- button submit and cancle --}}
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Save</button>
                            <a href="{{ route('landing-page') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </form>
@endsection

@section('other_js')
    <script>
        const avatar = document.querySelector('#avatar');
        const showImage = document.querySelector('#showImage');

        avatar.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    showImage.setAttribute('src', this.result);
                });
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
