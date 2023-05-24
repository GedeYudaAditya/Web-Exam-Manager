@extends('layouts.app')

@php
    // remove duplicate data user in leaderboard
    $leaderboard['paru'] = $leaderboard['paru']->unique('Username');
    $leaderboard['ginjal'] = $leaderboard['ginjal']->unique('Username');
    $leaderboard['reproduksi'] = $leaderboard['reproduksi']->unique('Username');
@endphp

<style>
    .bg-gold {
        background-color: #f9fc42;
        color: black;
        font-weight: bold;
    }

    .bg-silver {
        background-color: #d1d1d1;
        color: black;
        font-weight: bold;
    }

    .bg-browns {
        background-color: #CD7F32;
        color: black;
        font-weight: bold;
    }

    .image-clear-bg {
        width: 30px;
        margin: auto !important;
    }
</style>

@section('content')
    <div class="container mt-20">

        <h3 class="text-center font-bold text-2xl mb-5">Leaderboard Test Paru-Paru</h3>
        <table class="container dark:bg-slate-800 dark:text-white rounded shadow-md mb-5 p-10 bg-white">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Rank</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">NIM</th>
                    <th class="border px-4 py-2">Score</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 0;
                @endphp
                @forelse ($leaderboard['paru'] as $item)
                    @php
                        // check if the test name is same as the previous one reset the rank
                        if ($loop->index > 0 && $item['Test Name'] != $leaderboard['paru'][$loop->index - 1]['Test Name']) {
                            $rank = 1;
                        } else {
                            $rank++;
                        }
                        
                    @endphp
                    @if ($loop->index > 0 && $item['Test Name'] == $leaderboard['paru'][$loop->index - 1]['Test Name'])
                        <tr
                            class="{{ $loop->index == 0 ? 'bg-gold' : '' }} {{ $loop->index == 1 ? 'bg-silver' : '' }} {{ $loop->index == 2 ? 'bg-browns' : '' }}">

                            @if ($loop->index == 0)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/1st.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 1)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/2nd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 2)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/3rd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @else
                                <td class="border px-4 py-2 text-center font-bold">{{ $rank }}</td>
                            @endif

                            <td class="border px-4 py-2">{{ $item['Username'] }}</td>
                            <td class="border px-4 py-2">{{ $item['nim'] }}</td>
                            <td class="border px-4 py-2">{{ $item->score }}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="border px-4 py-2 text-lg text-center font-bold bg-blue-500" colspan="4">
                                {{ $item['Test Name'] }}</td>
                        </tr>
                        <tr
                            class="{{ $loop->index == 0 ? 'bg-gold' : '' }} {{ $loop->index == 1 ? 'bg-silver' : '' }} {{ $loop->index == 2 ? 'bg-browns' : '' }}">

                            @if ($loop->index == 0)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/1st.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 1)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/2nd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 2)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/3rd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @else
                                <td class="border px-4 py-2 text-center font-bold">{{ $rank }}</td>
                            @endif

                            <td class="border px-4 py-2">{{ $item['Username'] }}</td>
                            <td class="border px-4 py-2">{{ $item['nim'] }}</td>
                            <td class="border px-4 py-2">{{ $item->score }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h3 class="text-center font-bold text-2xl mb-5">Leaderboard Test Ginjal</h3>

        <table class="container dark:bg-slate-800 dark:text-white rounded shadow-md mb-5 p-10 bg-white">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Rank</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">NIM</th>
                    <th class="border px-4 py-2">Score</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 0;
                @endphp
                @forelse ($leaderboard['ginjal'] as $item)
                    @php
                        // check if the test name is same as the previous one reset the rank
                        if ($loop->index > 0 && $item['Test Name'] != $leaderboard['ginjal'][$loop->index - 1]['Test Name']) {
                            $rank = 1;
                        } else {
                            $rank++;
                        }
                        
                    @endphp
                    @if ($loop->index > 0 && $item['Test Name'] == $leaderboard['ginjal'][$loop->index - 1]['Test Name'])
                        <tr
                            class="{{ $loop->index == 0 ? 'bg-gold' : '' }} {{ $loop->index == 1 ? 'bg-silver' : '' }} {{ $loop->index == 2 ? 'bg-browns' : '' }}">
                            @if ($loop->index == 0)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/1st.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 1)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/2nd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 2)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/3rd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @else
                                <td class="border px-4 py-2 text-center font-bold">{{ $rank }}</td>
                            @endif
                            <td class="border px-4 py-2">{{ $item['Username'] }}</td>
                            <td class="border px-4 py-2">{{ $item['nim'] }}</td>
                            <td class="border px-4 py-2">{{ $item->score }}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="border px-4 py-2 text-lg text-center font-bold bg-blue-500" colspan="4">
                                {{ $item['Test Name'] }}</td>
                        </tr>
                        <tr
                            class="{{ $loop->index == 0 ? 'bg-gold' : '' }} {{ $loop->index == 1 ? 'bg-silver' : '' }} {{ $loop->index == 2 ? 'bg-browns' : '' }}">
                            @if ($loop->index == 0)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/1st.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 1)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/2nd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 2)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/3rd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @else
                                <td class="border px-4 py-2 text-center font-bold">{{ $rank }}</td>
                            @endif
                            <td class="border px-4 py-2">{{ $item['Username'] }}</td>
                            <td class="border px-4 py-2">{{ $item['nim'] }}</td>
                            <td class="border px-4 py-2">{{ $item->score }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h3 class="text-center font-bold text-2xl mb-5">Leaderboard Test Reproduksi Wanita</h3>

        <table class="container dark:bg-slate-800 dark:text-white rounded shadow-md mb-5 p-10 bg-white">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Rank</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">NIM</th>
                    <th class="border px-4 py-2">Score</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 0;
                @endphp
                @forelse ($leaderboard['reproduksi'] as $item)
                    @php
                        // check if the test name is same as the previous one reset the rank
                        if ($loop->index > 0 && $item['Test Name'] != $leaderboard['reproduksi'][$loop->index - 1]['Test Name']) {
                            $rank = 1;
                        } else {
                            $rank++;
                        }
                        
                    @endphp
                    @if ($loop->index > 0 && $item['Test Name'] == $leaderboard['reproduksi'][$loop->index - 1]['Test Name'])
                        <tr
                            class="{{ $loop->index == 0 ? 'bg-gold' : '' }} {{ $loop->index == 1 ? 'bg-silver' : '' }} {{ $loop->index == 2 ? 'bg-browns' : '' }}">
                            @if ($loop->index == 0)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/1st.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 1)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/2nd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 2)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/3rd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @else
                                <td class="border px-4 py-2 text-center font-bold">{{ $rank }}</td>
                            @endif
                            <td class="border px-4 py-2">{{ $item['Username'] }}</td>
                            <td class="border px-4 py-2">{{ $item['nim'] }}</td>
                            <td class="border px-4 py-2">{{ $item->score }}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="border px-4 py-2 text-lg text-center font-bold bg-blue-500" colspan="4">
                                {{ $item['Test Name'] }}</td>
                        </tr>
                        <tr
                            class="{{ $loop->index == 0 ? 'bg-gold' : '' }} {{ $loop->index == 1 ? 'bg-silver' : '' }} {{ $loop->index == 2 ? 'bg-browns' : '' }}">
                            @if ($loop->index == 0)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/1st.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 1)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/2nd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @elseif ($loop->index == 2)
                                <td class="border px-4 py-2 text-center font-bold flex-row justify-center">
                                    <img src="{{ asset('/images/3rd.png') }}" alt="" class="image-clear-bg">
                                </td>
                            @else
                                <td class="border px-4 py-2 text-center font-bold">{{ $rank }}</td>
                            @endif
                            <td class="border px-4 py-2">{{ $item['Username'] }}</td>
                            <td class="border px-4 py-2">{{ $item['nim'] }}</td>
                            <td class="border px-4 py-2">{{ $item->score }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
