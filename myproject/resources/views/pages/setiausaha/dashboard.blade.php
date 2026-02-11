@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-6 space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Dashboard Setiausaha</h1>
            <p class="text-sm text-gray-600">Selamat datang ke portal pengurusan Alumni 4B Johor.</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('register') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="8.5" cy="7" r="4"/>
                    <path d="M20 8v6M23 11h-6"/>
                </svg>
                Daftar Ahli Baru
            </a>

            <button class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-red-500 rounded-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>
                Pengesahan
            </button>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @php
            $cards = [
                ['title'=>'Jumlah Ahli','value'=>'2100','desc'=>'Ahli berdaftar di Johor'],
                ['title'=>'Menunggu Pengesahan','value'=>'7','desc'=>'Permohonan belum disahkan'],
                ['title'=>'Ahli Baru Bulan Ini','value'=>'32','desc'=>'+8% dari bulan lepas'],
                ['title'=>'Permohonan Tukar Negeri','value'=>'2','desc'=>'Menunggu tindakan'],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="border border-[#BAC4F7] rounded-lg p-4 bg-white">
                <p class="text-sm text-gray-500">{{ $card['title'] }}</p>
                <h2 class="text-2xl font-bold">{{ $card['value'] }}</h2>
                <p class="text-xs text-gray-400">{{ $card['desc'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Tabs + Content --}}
    <div x-data="{ tab: 'menunggu' }" class="space-y-4">

        {{-- Tabs --}}
        <div class="inline-flex bg-[#EEF1FF] rounded-md p-1 gap-1">
            <button
                @click="tab = 'menunggu'"
                :class="tab === 'menunggu' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-4 py-2 text-sm font-medium rounded-md transition"
            >
                Menunggu Pengesahan
            </button>

            <button
                @click="tab = 'terkini'"
                :class="tab === 'terkini' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-4 py-2 text-sm font-medium rounded-md transition"
            >
                Ahli Terkini
            </button>
        </div>

        {{-- Card (Switching Content) --}}
        <div class="border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">

            {{-- MENUNGGU PENGESAHAN --}}
            <div x-show="tab === 'menunggu'">
                <div class="p-6 border-b">
                    <h2 class="font-semibold">Permohonan Menunggu Pengesahan</h2>
                    <p class="text-sm text-gray-500">Senarai permohonan keahlian yang menunggu pengesahan anda.</p>
                </div>

                <div class="p-2 md:p-4 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-left border-b border-[#BAC4F7]">
                            <tr>
                                <th class="p-3">ID</th>
                                <th>Nama</th>
                                <th>Tarikh Mohon</th>
                                <th>Status</th>
                                <th class="text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(range(1,5) as $i)
                                <tr class="border-b border-[#BAC4F7]/60">
                                    <td class="p-3">P00{{ $i }}</td>
                                    <td>Nama Pemohon {{ $i }} (Johor)</td>
                                    <td>15/03/2025</td>
                                    <td>
                                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                                            Menunggu Pengesahan
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="px-3 py-1 text-xs border border-indigo-600 text-indigo-600 rounded-md">
                                            Sahkan
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-4 text-center">
                        <button class="px-4 py-2 text-sm border rounded-md">
                            Lihat Semua Permohonan
                        </button>
                    </div>
                </div>
            </div>

            {{-- AHLI TERKINI --}}
            <div x-show="tab === 'terkini'" x-cloak>
                <div class="p-6">
                    <h2 class="text-2xl font-bold">Ahli Terkini</h2>
                    <p class="text-sm text-gray-600 mt-1">Senarai ahli yang baru disahkan.</p>

                    <div class="mt-6 overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="text-left border-b border-[#BAC4F7]">
                                <tr>
                                    <th class="py-3 pr-4 w-[140px]">No. Ahli</th>
                                    <th class="py-3 pr-4">Nama</th>
                                    <th class="py-3 pr-4 w-[160px]">Tarikh Daftar</th>
                                    <th class="py-3 w-[140px]">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $ahliTerkini = [
                                        ['no'=>'A12345', 'nama'=>'Ahmad bin Abdullah (Johor)', 'tarikh'=>'01/03/2025'],
                                        ['no'=>'A12346', 'nama'=>'Siti binti Hassan (Johor)', 'tarikh'=>'28/02/2025'],
                                        ['no'=>'A12347', 'nama'=>'Ravi a/l Chandran (Johor)', 'tarikh'=>'25/02/2025'],
                                        ['no'=>'A12348', 'nama'=>'Lim Mei Ling (Johor)', 'tarikh'=>'20/02/2025'],
                                    ];
                                @endphp

                                @foreach($ahliTerkini as $a)
                                    <tr class="border-b border-[#BAC4F7]/60">
                                        <td class="py-4 pr-4 font-medium">{{ $a['no'] }}</td>
                                        <td class="py-4 pr-4">{{ $a['nama'] }}</td>
                                        <td class="py-4 pr-4">{{ $a['tarikh'] }}</td>
                                        <td class="py-4">
                                            <span class="inline-flex items-center rounded-full bg-green-100 text-green-700 px-3 py-1 text-xs font-medium">
                                                Disahkan
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 flex justify-center">
                        <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#BAC4F7] px-6 py-2 text-sm font-medium hover:bg-gray-50">
                            Lihat Semua Ahli
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
