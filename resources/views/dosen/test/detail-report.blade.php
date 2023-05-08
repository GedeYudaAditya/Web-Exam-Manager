@extends('layouts.app')

@section('content')
    <div class="container pt-20">
        <h3 class="text-center font-bold text-2xl mb-5">Test {{ $report->test->name }}</h3>
    </div>

    {{-- layout untuk result --}}
    <div class="container mx-auto py-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4">
                <h2 class="text-lg font-medium text-gray-800">Hasil Test</h2>
                <hr class="my-4">
                <div class="flex flex-wrap justify-between">
                    <div class="w-full md:w-1/3 mb-4 md:mb-0">
                        <p class="text-gray-600">Total Score</p>
                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ $report->score }}%
                        </h3>
                    </div>
                    <div class="w-full md:w-1/3 mb-4 md:mb-0">
                        <p class="text-gray-600">Pass Grade</p>
                        <h3 class="text-2xl font-bold text-gray-800">
                            @if ($report->score >= $report->test->passing_score)
                                Lulus
                            @else
                                Tidak Lulus
                            @endif
                        </h3>
                    </div>
                    <div class="w-full md:w-1/3 mb-4 md:mb-0">
                        <p class="text-gray-600">Duration</p>
                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ $report->test->duration }} Menit
                        </h3>
                    </div>
                </div>
                <hr class="my-4">
                <div class="flex flex-wrap justify-between">
                    <div class="w-full md:w-1/2 mb-4 md:mb-0">
                        <p class="text-gray-600">Correct Answers</p>
                        <h3 class="text-lg font-medium text-green-600">
                            {{ $report->correct_answer }}
                        </h3>
                    </div>
                    <div class="w-full md:w-1/2 mb-4 md:mb-0">
                        <p class="text-gray-600">Incorrect Answers</p>
                        <h3 class="text-lg font-medium text-red-600">
                            {{ $report->test->questions->count() - $report->correct_answer }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- layout untuk detail jawaban --}}
    <div class="container mx-auto py-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4">
                <h2 class="text-lg font-medium text-gray-800">Detail Jawaban</h2>
                <hr class="my-4">
                <div class="flex flex-col md:grid md:grid-cols-2 gap-2 justify-between place-content-stretch">
                    @foreach ($report->detailReports as $answer)
                        <div class="w-full md:w-1/2 mb-4 md:mb-0">
                            <p class="text-gray-600">
                                @if ($answer->user_answer == null && $answer->essay_answer == null)
                                    <span class="text-red-500">Tidak menjawab</span>
                                @endif
                                Pertanyaan {{ $loop->iteration }}
                            </p>
                            @if ($answer->question->embed)
                                {{-- make embed --}}
                                {{-- filter the $answer->question->video url first --}}
                                @php
                                    $video = $answer->question->embed;
                                    if (Str::contains($video, 'watch?v=')) {
                                        $embed = Str::replaceFirst('watch?v=', 'embed/', $video);
                                    } else {
                                        $embed = Str::replaceFirst('youtu.be/', 'youtube.com/embed/', $video);
                                    }
                                @endphp
                                <div class="flex flex-col">
                                    <iframe src="{{ $embed }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        class="border border-gray-300 rounded p-2 w-full aspect-video object-cover object-center"></iframe>
                                </div>
                            @endif
                            @if ($answer->question->image)
                                <div class="flex flex-col">
                                    <img src="{{ asset('storage/images/' . $answer->question->image) }}" alt="image"
                                        class="w-64 aspect-square">
                                </div>
                            @endif
                            <h3 class="text-lg text-gray-800">
                                <p
                                    class="mb-3 font-medium {{ $answer->user_answer == null && $answer->essay_answer == null ? 'text-red-500' : '' }}">
                                    {{ $answer->question->question }}</p>
                                {{-- option --}}
                                {{-- bentuk table --}}
                                @if ($answer->question->type != 'essay')
                                    <div>
                                        <table>
                                            <tr>
                                                <td
                                                    class="flex flex-row items-start {{ $answer->question->correct_answer == 'a' ? 'text-green-500' : '' }} {{ $answer->user_answer == 'a' && $answer->question->correct_answer != 'a' ? 'text-red-500' : '' }}">
                                                    <h4 class="font-bold">A. </span></h4>
                                                </td>
                                                <td
                                                    class="{{ $answer->question->correct_answer == 'a' ? 'text-green-500 font-bold' : '' }} {{ $answer->user_answer == 'a' && $answer->question->correct_answer != 'a' ? 'text-red-500 font-bold' : '' }}">
                                                    {{ $answer->question->option_a }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="flex flex-row items-start {{ $answer->question->correct_answer == 'b' ? 'text-green-500' : '' }} {{ $answer->user_answer == 'b' && $answer->question->correct_answer != 'b' ? 'text-red-500' : '' }}">
                                                    <h4 class="font-bold">B. </span></h4>
                                                </td>
                                                <td
                                                    class="{{ $answer->question->correct_answer == 'b' ? 'text-green-500 font-bold' : '' }} {{ $answer->user_answer == 'b' && $answer->question->correct_answer != 'b' ? 'text-red-500 font-bold' : '' }}">
                                                    {{ $answer->question->option_b }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="flex flex-row items-start {{ $answer->question->correct_answer == 'c' ? 'text-green-500' : '' }} {{ $answer->user_answer == 'c' && $answer->question->correct_answer != 'c' ? 'text-red-500' : '' }}">
                                                    <h4 class="font-bold">C. </span></h4>
                                                </td>
                                                <td
                                                    class="{{ $answer->question->correct_answer == 'c' ? 'text-green-500 font-bold' : '' }} {{ $answer->user_answer == 'c' && $answer->question->correct_answer != 'c' ? 'text-red-500 font-bold' : '' }}">
                                                    {{ $answer->question->option_c }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="flex flex-row items-start {{ $answer->question->correct_answer == 'd' ? 'text-green-500' : '' }} {{ $answer->user_answer == 'd' && $answer->question->correct_answer != 'd' ? 'text-red-500' : '' }}">
                                                    <h4 class="font-bold">D. </span></h4>
                                                </td>
                                                <td
                                                    class="{{ $answer->question->correct_answer == 'd' ? 'text-green-500 font-bold' : '' }} {{ $answer->user_answer == 'd' && $answer->question->correct_answer != 'd' ? 'text-red-500 font-bold' : '' }}">
                                                    {{ $answer->question->option_d }}
                                                </td>
                                            </tr>
                                            @if ($answer->question->option_e)
                                                <tr>
                                                    <td
                                                        class="flex flex-row items-start {{ $answer->question->correct_answer == 'e' ? 'text-green-500' : '' }} {{ $answer->user_answer == 'e' && $answer->question->correct_answer != 'e' ? 'text-red-500' : '' }}">
                                                        <h4 class="font-bold">E. </span></h4>
                                                    </td>
                                                    <td
                                                        class="{{ $answer->question->correct_answer == 'e' ? 'text-green-500 font-bold' : '' }} {{ $answer->user_answer == 'e' && $answer->question->correct_answer != 'e' ? 'text-red-500 font-bold' : '' }}">
                                                        {{ $answer->question->option_e }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                @else
                                    <label class="text-sm text-slate-600" for="{{ $answer->slug }}">Jawaban User:</label>
                                    <textarea class="w-full bg-slate-400 p-2 rounded" id="{{ $answer->slug }}">{{ $answer->essay_answer }}</textarea>
                                @endif
                            </h3>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
