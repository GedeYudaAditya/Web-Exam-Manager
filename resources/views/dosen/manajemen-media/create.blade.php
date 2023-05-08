@extends('layouts.app')

@section('content')
    <div class="container mt-20">
        <h3 class="text-center font-bold text-2xl mb-5">Tambah Video</h3>

        <div class="container rounded shadow-md p-10 mb-10 bg-white">
            <form action="{{ route('dosen.media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container flex flex-col">
                    <label for="judul" class="font-bold">Judul Video</label>
                    <input type="text" name="name" id="judul" class="border-2 rounded-md p-2 mb-5"
                        value="{{ old('name') }}">

                    <label for="deskripsi" class="font-bold">Deskripsi Video</label>
                    <textarea name="description" id="deskripsi" cols="30" rows="10" class="border-2 rounded-md p-2 mb-5"
                        value="{{ old('description') }}"></textarea>

                    {{-- input for video embeded --}}
                    <div class="flex flex-col mb-5">
                        <label for="video" class="font-bold">Video</label>
                        <input type="text" name="embed" id="video" class="border rounded p-2"
                            value="{{ old('embed') }}" onchange="previewVideo()">
                    </div>

                    {{-- preview embeded --}}
                    <div class="flex flex-col mb-5" id="vid" style="display: none;">
                        <label for="video" class="font-bold">Preview Video</label>
                        <iframe src="" frameborder="0" id="preview-video"
                            class="border border-gray-300 rounded p-2 w-full aspect-video object-cover object-center"></iframe>
                    </div>

                    {{-- category --}}
                    <label for="category" class="font-bold">Kategori</label>
                    <select name="category" id="category" class="border-2 rounded-md p-2 mb-5">
                        <option>Pilih Kategori</option>
                        <option value="paru" {{ old('category') == 'paru' ? 'selected' : '' }}>Paru</option>
                        <option value="ginjal" {{ old('category') == 'ginjal' ? 'selected' : '' }}>Ginjal</option>
                        <option value="reproduksi" {{ old('category') == 'reproduksi' ? 'selected' : '' }}>Reproduksi
                        </option>
                    </select>

                    {{-- status --}}
                    <label for="status" class="font-bold">Status</label>
                    <select name="status" id="status" class="border-2 rounded-md p-2 mb-5">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>

                    <button type="submit" class="button">Tambah Video</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('other_js')
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
@endsection
