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
@endsection
