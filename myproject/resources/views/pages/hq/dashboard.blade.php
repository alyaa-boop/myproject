@extends('layouts.app')

@section('title', 'Dashboard Pentadbir HQ')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10 space-y-6" x-data="{ tab: 'menunggu' }">

    {{-- Header --}}
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Dashboard Pentadbir HQ</h1>
            <p class="text-sm text-gray-600">Selamat datang ke portal pengurusan Alumni 4B Malaysia.</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('hq.pengesahan') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-red-500 rounded-md hover:bg-red-600">
                {{-- check-circle --}}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>
                Pengesahan
                <span class="ml-1 inline-flex items-center justify-center rounded-full bg-white/20 px-2 py-0.5 text-xs">
                    12
                </span>
            </a>

            <a href="{{ route('hq.laporan') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-primary rounded-md hover:bg-primary/90">
                {{-- report icon --}}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 17v-6m4 6V7m4 10v-4M3 3v18h18"/>
                </svg>
                Laporan
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    @php
        $cards = [
            ['title'=>'Jumlah Ahli','value'=>'15250','desc'=>'Ahli berdaftar di seluruh Malaysia'],
            ['title'=>'Menunggu No. Ahli','value'=>'12','desc'=>'Permohonan menunggu nombor ahli'],
            ['title'=>'Ahli Baru Bulan Ini','value'=>'124','desc'=>'+12% dari bulan lepas'],
            ['title'=>'Permohonan Tukar Negeri','value'=>'8','desc'=>'Permohonan menunggu kelulusan'],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @foreach($cards as $card)
            <div class="border border-[#BAC4F7] rounded-lg p-4 bg-white">
                <div class="flex items-start justify-between">
                    <p class="text-sm text-gray-500">{{ $card['title'] }}</p>
                    <span class="text-gray-300">
                        {{-- small info icon --}}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 16v-4"/>
                            <path d="M12 8h.01"/>
                        </svg>
                    </span>
                </div>
                <h2 class="text-2xl font-bold mt-1">{{ $card['value'] }}</h2>
                <p class="text-xs text-gray-400 mt-1">{{ $card['desc'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Tabs --}}
    <div class="inline-flex bg-[#EEF1FF] rounded-md p-1 gap-1">
        <button
            @click="tab='menunggu'"
            :class="tab==='menunggu' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
            class="px-4 py-2 text-sm font-medium rounded-md transition"
        >
            Menunggu No. Ahli
        </button>

        <button
            @click="tab='terkini'"
            :class="tab==='terkini' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
            class="px-4 py-2 text-sm font-medium rounded-md transition"
        >
            Ahli Terkini
        </button>

        <button
            @click="tab='statistik'"
            :class="tab==='statistik' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
            class="px-4 py-2 text-sm font-medium rounded-md transition"
        >
            Statistik Negeri
        </button>
    </div>

    {{-- Content Card --}}
    <div class="border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">

        {{-- MENUNGGU NO. AHLI --}}
        <div x-show="tab==='menunggu'" x-cloak>
            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="font-semibold">Permohonan Menunggu No. Ahli</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Senarai permohonan keahlian yang telah disahkan oleh Setiausaha Negeri dan menunggu nombor ahli.
                </p>
            </div>

            <div class="p-2 md:p-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3 w-[90px]">ID</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3 w-[160px]">Tarikh Mohon</th>
                            <th class="p-3 w-[140px]">Negeri</th>
                            <th class="p-3 w-[170px]">Status</th>
                            <th class="p-3 w-[160px]">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $rows = [
                                ['id'=>'P001','nama'=>'Azman bin Aziz','tarikh'=>'15/03/2025','negeri'=>'Selangor'],
                                ['id'=>'P002','nama'=>'Nurul Huda binti Ismail','tarikh'=>'14/03/2025','negeri'=>'Johor'],
                                ['id'=>'P003','nama'=>'Jason Wong','tarikh'=>'12/03/2025','negeri'=>'Pulau Pinang'],
                                ['id'=>'P004','nama'=>'Aini binti Yusof','tarikh'=>'10/03/2025','negeri'=>'Kedah'],
                                ['id'=>'P005','nama'=>'Muthu a/l Selvan','tarikh'=>'08/03/2025','negeri'=>'Perak'],
                            ];
                        @endphp

                        @foreach($rows as $r)
                            <tr class="border-b border-[#BAC4F7]/60">
                                <td class="p-3">{{ $r['id'] }}</td>
                                <td class="p-3">{{ $r['nama'] }}</td>
                                <td class="p-3">{{ $r['tarikh'] }}</td>
                                <td class="p-3">{{ $r['negeri'] }}</td>
                                <td class="p-3">
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-800 px-3 py-1 text-xs font-medium">
                                        Menunggu No. Ahli
                                    </span>
                                </td>
                                <td class="p-3">
                                    <button class="px-3 py-1.5 text-xs border border-[#BAC4F7] rounded-md hover:bg-gray-50">
                                        Beri No. Ahli
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4 flex justify-center">
                    <button class="px-4 py-2 text-sm border border-[#BAC4F7] rounded-md hover:bg-gray-50">
                        Lihat Semua Permohonan
                    </button>
                </div>
            </div>
        </div>

        {{-- AHLI TERKINI --}}
        <div x-show="tab==='terkini'" x-cloak>
            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="font-semibold">Ahli Terkini</h2>
                <p class="text-sm text-gray-500 mt-1">Senarai ahli yang baru didaftarkan.</p>
            </div>

            <div class="p-2 md:p-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3 w-[120px]">No. Ahli</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3 w-[160px]">Tarikh Daftar</th>
                            <th class="p-3 w-[160px]">Negeri</th>
                            <th class="p-3 w-[140px]">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $ahliTerkini = [
                                ['no'=>'A12345', 'nama'=>'Ahmad bin Abdullah', 'tarikh'=>'01/03/2025', 'negeri'=>'Selangor'],
                                ['no'=>'A12346', 'nama'=>'Siti binti Hassan', 'tarikh'=>'28/02/2025', 'negeri'=>'Johor'],
                                ['no'=>'A12347', 'nama'=>'Ravi a/l Chandran', 'tarikh'=>'25/02/2025', 'negeri'=>'Pulau Pinang'],
                                ['no'=>'A12348', 'nama'=>'Lim Mei Ling', 'tarikh'=>'20/02/2025', 'negeri'=>'Johor'],
                            ];
                        @endphp

                        @foreach($ahliTerkini as $a)
                            <tr class="border-b border-[#BAC4F7]/60">
                                <td class="p-3">{{ $a['no'] }}</td>
                                <td class="p-3">{{ $a['nama'] }}</td>
                                <td class="p-3">{{ $a['tarikh'] }}</td>
                                <td class="p-3">{{ $a['negeri'] }}</td>
                                <td class="p-3">
                                    <span class="inline-flex items-center rounded-full bg-green-100 text-green-700 px-3 py-1 text-xs font-medium">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        {{-- STATISTIK NEGERI --}}
        <div x-show="tab==='statistik'" x-cloak>

            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="font-semibold">Statistik Ahli Mengikut Negeri</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Jumlah ahli berdaftar mengikut negeri.
                </p>
            </div>

            <div class="p-2 md:p-4 overflow-x-auto">
                @php
                    $negeriStats = [
                        ['negeri'=>'Selangor','jumlah'=>3250,'peratus'=>21.3],
                        ['negeri'=>'Johor','jumlah'=>2100,'peratus'=>13.8],
                        ['negeri'=>'Pulau Pinang','jumlah'=>1800,'peratus'=>11.8],
                        ['negeri'=>'Perak','jumlah'=>1200,'peratus'=>7.9],
                        ['negeri'=>'Kedah','jumlah'=>950,'peratus'=>6.2],
                        ['negeri'=>'Kelantan','jumlah'=>850,'peratus'=>5.6],
                        ['negeri'=>'Negeri Sembilan','jumlah'=>650,'peratus'=>4.3],
                        ['negeri'=>'Melaka','jumlah'=>550,'peratus'=>3.6],
                        ['negeri'=>'Pahang','jumlah'=>500,'peratus'=>3.3],
                        ['negeri'=>'Terengganu','jumlah'=>450,'peratus'=>3.0],
                        ['negeri'=>'Perlis','jumlah'=>300,'peratus'=>2.0],
                        ['negeri'=>'WP Kuala Lumpur','jumlah'=>400,'peratus'=>2.6],
                        ['negeri'=>'WP Putrajaya','jumlah'=>200,'peratus'=>1.3],
                    ];
                @endphp

                <table class="w-full text-sm">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3 w-[220px]">Negeri</th>
                            <th class="p-3 w-[160px]">Jumlah Ahli</th>
                            <th class="p-3">Peratusan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($negeriStats as $n)
                            <tr class="border-b border-[#BAC4F7]/60">
                                <td class="p-3">{{ $n['negeri'] }}</td>
                                <td class="p-3">{{ number_format($n['jumlah']) }}</td>
                                <td class="p-3">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-2 bg-primary rounded-full"
                                                style="width: {{ $n['peratus'] }}%;">
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-600 w-[40px] text-right">
                                            {{ $n['peratus'] }}%
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </div>
</div>
@endsection
