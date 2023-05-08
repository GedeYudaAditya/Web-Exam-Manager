@extends('layouts.app')

@section('content')
    <div class="container pt-20">
        <h3 class="text-center font-bold text-2xl mb-5">Buat Soal Untuk Test {{ $test->name }}</h3>
        <div class="container dark:bg-slate-800 rounded shadow-md p-10 mb-20 bg-white">
            <form action="{{ $route_update }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- alert all error --}}
                @if ($errors->any())
                    <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="font-bold">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p class="block font-bold text-white mb-5">
                    <span class="text-red-500">*</span> Wajib diisi
                </p>
                <div class="flex flex-col mb-5">
                    <label for="question" class="font-bold text-white">Pertanyaan <span
                            class="text-red-500">*</span></label>
                    <textarea name="question" id="question" class="border border-gray-300 rounded p-2">{{ $soal->question }}</textarea>
                </div>

                {{-- input for image --}}
                <div class="flex flex-col mb-5">
                    <label for="image" class="font-bold text-white">Gambar</label>
                    <input type="file" name="image" id="image" class="border bg-white border-gray-300 rounded p-2"
                        onchange="previewImage()">
                </div>

                @if ($soal->image != null)
                    {{-- preview image --}}
                    <div class="flex flex-col mb-5" id="prev">
                        <label for="image" class="font-bold text-white">Preview Gambar</label>
                        <img src="{{ asset('storage/images/' . $soal->image) }}" alt="" id="preview-image"
                            class="border border-gray-300 rounded p-2 w-80 h-80 object-cover object-center
                        ">
                    </div>
                @else
                    {{-- preview image --}}
                    <div class="flex flex-col mb-5" id="prev" style="display: none">
                        <label for="image" class="font-bold text-white">Preview Gambar</label>
                        <img src="" alt="" id="preview-image"
                            class="border border-gray-300 rounded p-2 w-80 h-80 object-cover object-center
                    ">
                    </div>
                @endif

                {{-- input for video embeded --}}
                <div class="flex flex-col mb-5">
                    <label for="video" class="font-bold text-white">Video</label>
                    <input type="text" name="embed" id="video" class="border border-gray-300 rounded p-2"
                        value="{{ $soal->embed }}" onchange="previewVideo()">
                </div>

                {{-- preview embeded --}}
                <div class="flex flex-col mb-5" id="vid" style="display: none;">
                    <label for="video" class="font-bold text-white">Preview Video</label>
                    <iframe src="" frameborder="0" id="preview-video"
                        class="border border-gray-300 rounded p-2 w-full aspect-video object-cover object-center"></iframe>
                </div>


                {{-- Jenis Pertanyaan --}}
                <div class="flex flex-col mb-5">
                    <label for="type" class="font-bold text-white">Jenis Pertanyaan <span
                            class="text-red-500">*</span></label>
                    <select name="type" id="type" class="border border-gray-300 rounded p-2">
                        <option value="essay" {{ $soal->type == 'essay' ? 'selected' : '' }}>Essay</option>
                        <option value="multiple_choice" {{ $soal->type == 'multiple_choice' ? 'selected' : '' }}>Multiple
                            Choice
                        </option>
                    </select>
                </div>

                <div id="multiple_choice">
                    <p class="font-bold text-white mb-3">
                        Pilihan Jawaban:
                    </p>
                    <div class="flex flex-row justify-between mb-5">
                        <div class="flex flex-col mb-5">
                            <label for="option_a" class="font-bold text-white">Pilihan A <span
                                    class="text-red-500">*</span></label>
                            <textarea type="text" name="option_a" id="option_a" rows="6" class="border border-gray-300 rounded p-2">{{ $soal->option_a }}</textarea>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="option_b" class="font-bold text-white">Pilihan B <span
                                    class="text-red-500">*</span></label>
                            <textarea type="text" name="option_b" id="option_b" rows="6" class="border border-gray-300 rounded p-2">{{ $soal->option_b }}</textarea>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="option_c" class="font-bold text-white">Pilihan C <span
                                    class="text-red-500">*</span></label>
                            <textarea type="text" name="option_c" id="option_c" rows="6" class="border border-gray-300 rounded p-2">{{ $soal->option_c }}</textarea>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="option_d" class="font-bold text-white">Pilihan D <span
                                    class="text-red-500">*</span></label>
                            <textarea type="text" name="option_d" id="option_d" rows="6" class="border border-gray-300 rounded p-2">{{ $soal->option_d }}</textarea>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="option_e" class="font-bold text-white">Pilihan E</label>
                            <textarea type="text" name="option_e" id="option_e" rows="6" class="border border-gray-300 rounded p-2">{{ $soal->option_e }}</textarea>
                        </div>
                    </div>
                    <div class="flex flex-col mb-5">
                        <label for="answer" class="font-bold text-white">Jawaban <span
                                class="text-red-500">*</span></label>
                        <select name="correct_answer" id="answer" class="border border-gray-300 rounded p-2">
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col mb-5">
                    <label for="score" class="font-bold text-white">Score <span class="text-red-500">*</span></label>
                    <input type="number" name="score" id="score" class="border border-gray-300 rounded p-2"
                        value="{{ $soal->score }}">
                </div>
                <div class="flex flex-row justify-center sm:justify-end mb-5">
                    <button type="submit" class="button me-5">
                        Simpan
                    </button>
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

@section('other_js')
    <script>
        $(document).ready(function() {
            if ($('#type').val() == 'essay') {
                $('#multiple_choice').hide();
            } else {
                $('#multiple_choice').show();
            }

            $('#type').change(function() {
                if ($('#type').val() == 'essay') {
                    $('#multiple_choice').hide();
                } else {
                    $('#multiple_choice').show();
                }
            });
        });
    </script>

    {{-- Preview image --}}
    <script>
        function previewImage() {
            document.getElementById("prev").style.display = "block";
            // show loading animation
            // document.getElementById("loading").style.display = "block";
            document.getElementById("preview-image").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image").files[0]);

            oFReader.onload = function(oFREvent) {
                console.log(oFREvent.target.result);
                document.getElementById("preview-image").src = oFREvent.target.result;
            };
        };
    </script>

    {{-- Preview video --}}
    <script>
        function previewVideo() {
            document.getElementById("vid").style.display = "block";
            document.getElementById("preview-video").style.display = "block";
            var video = document.getElementById("video").value;
            if (video.includes("watch?v=")) {
                var embed = video.replace("watch?v=", "embed/");
            } else {
                var embed = video.replace("youtu.be/", "youtube.com/embed/");
            }
            document.getElementById("preview-video").src = embed;
            // do not show loading animation
            document.getElementById("loading").style.display = "none";
        };
    </script>

    {{-- load preview if there is any value in first time page loaded --}}
    <script>
        $(document).ready(function() {
            // var image = document.getElementById("image").value;
            var video = document.getElementById("video").value;
            // if (image != "") {
            //     previewImage();
            // }
            if (video != "") {
                previewVideo();
            }
        });
    </script>
@endsection
