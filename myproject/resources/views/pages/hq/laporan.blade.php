@extends('layouts.app')

@section('title', 'Laporan - HQ')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10 space-y-6"
     x-data="{
        tab: 'tahunan',
        tahun: '2020'
     }">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold">Laporan</h1>
        <p class="text-sm text-gray-600">Laporan dan statistik keahlian Alumni 4B Malaysia.</p>
    </div>

    {{-- Tahun Dropdown --}}
    <div class="max-w-sm">
        <label class="block text-xs font-medium text-gray-700 mb-2">Tahun</label>
        <div class="relative">
            <select x-model="tahun"
                    class="w-full rounded-md border border-[#BAC4F7] px-3 py-2 pr-10 text-sm bg-white focus:border-primary focus:ring-1 focus:ring-primary">
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>

            {{-- dropdown icon --}}
            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="inline-flex bg-[#EEF1FF] rounded-md p-1 gap-1">
        <button @click="tab='tahunan'"
                :class="tab==='tahunan' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-4 py-2 text-sm font-medium rounded-md transition">
            Laporan Tahunan
        </button>

        <button @click="tab='kaum'"
                :class="tab==='kaum' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-4 py-2 text-sm font-medium rounded-md transition">
            Demografi Kaum
        </button>

        <button @click="tab='negeri'"
                :class="tab==='negeri' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-4 py-2 text-sm font-medium rounded-md transition">
            Statistik Negeri
        </button>

        <button @click="tab='tukar'"
                :class="tab==='tukar' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-4 py-2 text-sm font-medium rounded-md transition">
            Permohonan Tukar Negeri
        </button>
    </div>

    {{-- Card --}}
    <div class="border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">

        {{-- TAB: LAPORAN TAHUNAN --}}
        <div x-show="tab==='tahunan'" x-cloak>
            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="text-lg font-semibold">Laporan Jumlah Keahlian Tahunan</h2>
                <p class="text-sm text-gray-500 mt-1">Statistik keahlian Alumni 4B Malaysia mengikut tahun.</p>
            </div>

            @php
                $laporan = [
                    ['tahun'=>2020,'jumlah'=>12500,'baru'=>1200,'tamat'=>-800,'meninggal'=>-50],
                    ['tahun'=>2021,'jumlah'=>13000,'baru'=>1300,'tamat'=>-750,'meninggal'=>-50],
                    ['tahun'=>2022,'jumlah'=>13800,'baru'=>1500,'tamat'=>-650,'meninggal'=>-50],
                    ['tahun'=>2023,'jumlah'=>14500,'baru'=>1400,'tamat'=>-650,'meninggal'=>-50],
                    ['tahun'=>2024,'jumlah'=>15000,'baru'=>1200,'tamat'=>-650,'meninggal'=>-50],
                    ['tahun'=>2025,'jumlah'=>15250,'baru'=>400,'tamat'=>-150,'meninggal'=>0],
                ];
            @endphp

            <div class="p-2 md:p-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3">Tahun</th>
                            <th class="p-3">Jumlah Ahli</th>
                            <th class="p-3">Ahli Baru</th>
                            <th class="p-3">Tamat Tempoh</th>
                            <th class="p-3">Meninggal Dunia</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($laporan as $row)
                            {{-- optional filter by dropdown: show from selected year onwards like screenshot feel --}}
                            <tr class="border-b border-[#BAC4F7]/60" x-show="parseInt('{{ $row['tahun'] }}') >= parseInt(tahun)">
                                <td class="p-3">{{ $row['tahun'] }}</td>
                                <td class="p-3">{{ number_format($row['jumlah']) }}</td>

                                <td class="p-3">
                                    <span class="text-green-600">
                                        +{{ number_format($row['baru']) }}
                                    </span>
                                </td>

                                <td class="p-3">
                                    <span class="text-yellow-600">
                                        {{ $row['tamat'] }}
                                    </span>
                                </td>

                                <td class="p-3">
                                    <span class="text-red-600">
                                        {{ $row['meninggal'] == 0 ? '-0' : $row['meninggal'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        {{-- TAB: DEMOGRAFI KAUM --}}
        <div x-show="tab==='kaum'" x-cloak>

            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="text-lg font-semibold">Demografi Kaum</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Statistik keahlian Alumni 4B Malaysia mengikut kaum.
                </p>
            </div>

            @php
                $demografi = [
                    ['kaum'=>'Melayu','jumlah'=>9150,'peratus'=>60],
                    ['kaum'=>'Cina','jumlah'=>3050,'peratus'=>20],
                    ['kaum'=>'India','jumlah'=>2287,'peratus'=>15],
                    ['kaum'=>'Bumiputera Sabah','jumlah'=>382,'peratus'=>2.5],
                    ['kaum'=>'Bumiputera Sarawak','jumlah'=>382,'peratus'=>2.5],
                    ['kaum'=>'Lain-lain','jumlah'=>0,'peratus'=>0],
                ];
            @endphp

            <div class="p-2 md:p-4 overflow-x-auto">
                <table class="w-full text-sm table-auto">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3 w-[250px]">Kaum</th>
                            <th class="p-3 w-[180px]">Jumlah Ahli</th>
                            <th class="p-3">Peratusan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($demografi as $d)
                        <tr class="border-b border-[#BAC4F7]/60">
                            <td class="p-3">{{ $d['kaum'] }}</td>

                            <td class="p-3">
                                {{ number_format($d['jumlah']) }}
                            </td>

                            <td class="p-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-2 bg-primary rounded-full"
                                            style="width: {{ $d['peratus'] }}%;">
                                        </div>
                                    </div>

                                    <span class="text-xs text-gray-600 w-[45px] text-right">
                                        {{ $d['peratus'] }}%
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>


        {{-- TAB: STATISTIK NEGERI --}}
        <div x-show="tab==='negeri'" x-cloak>

            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="text-lg font-semibold">Statistik Negeri</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Statistik keahlian Alumni 4B Malaysia mengikut negeri.
                </p>
            </div>

            @php
                // Left column: total members by state
                $jumlahNegeri = [
                    ['negeri'=>'Selangor','jumlah'=>3250],
                    ['negeri'=>'Johor','jumlah'=>2100],
                    ['negeri'=>'Pulau Pinang','jumlah'=>1800],
                    ['negeri'=>'Sabah','jumlah'=>1500],
                    ['negeri'=>'Sarawak','jumlah'=>1450],
                ];

                // Right column: new members in 2025 by state
                $baru2025 = [
                    ['negeri'=>'Selangor','jumlah'=>120],
                    ['negeri'=>'Johor','jumlah'=>80],
                    ['negeri'=>'Pulau Pinang','jumlah'=>60],
                    ['negeri'=>'Sabah','jumlah'=>40],
                    ['negeri'=>'Sarawak','jumlah'=>30],
                ];

                $maxJumlah = max(array_column($jumlahNegeri, 'jumlah'));
                $maxBaru = max(array_column($baru2025, 'jumlah'));
            @endphp

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    {{-- LEFT: Jumlah ahli mengikut negeri --}}
                    <div>
                        <h3 class="font-semibold mb-4">Jumlah Ahli Mengikut Negeri</h3>

                        <div class="space-y-4">
                            @foreach($jumlahNegeri as $n)
                                @php
                                    $pct = $maxJumlah > 0 ? ($n['jumlah'] / $maxJumlah) * 100 : 0;
                                @endphp

                                <div>
                                    <div class="flex items-center justify-between text-sm mb-2">
                                        <span>{{ $n['negeri'] }}</span>
                                        <span class="font-medium">{{ number_format($n['jumlah']) }}</span>
                                    </div>

                                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-2 rounded-full bg-primary"
                                            style="width: {{ $pct }}%;">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- RIGHT: Ahli baru tahun 2025 --}}
                    <div>
                        <h3 class="font-semibold mb-4">Ahli Baru Tahun 2025</h3>

                        <div class="space-y-4">
                            @foreach($baru2025 as $n)
                                @php
                                    $pct = $maxBaru > 0 ? ($n['jumlah'] / $maxBaru) * 100 : 0;
                                @endphp

                                <div>
                                    <div class="flex items-center justify-between text-sm mb-2">
                                        <span>{{ $n['negeri'] }}</span>
                                        <span class="font-medium">{{ number_format($n['jumlah']) }}</span>
                                    </div>

                                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-2 rounded-full"
                                            style="width: {{ $pct }}%; background-color: #dc2626;">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>


        {{-- TAB: PERMOHONAN TUKAR NEGERI --}}
        <div x-show="tab==='tukar'" x-cloak>

            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="text-lg font-semibold">Permohonan Tukar Negeri</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Senarai permohonan tukar negeri yang menunggu kelulusan.
                </p>
            </div>

            @php
                $tukarNegeri = [
                    ['id'=>'T001','nama'=>'Ahmad bin Abdullah','semasa'=>'Selangor','dipohon'=>'Johor','tarikh'=>'15/03/2025'],
                    ['id'=>'T002','nama'=>'Siti binti Hassan','semasa'=>'Johor','dipohon'=>'Selangor','tarikh'=>'10/03/2025'],
                    ['id'=>'T003','nama'=>'Ravi a/l Chandran','semasa'=>'Pulau Pinang','dipohon'=>'Perak','tarikh'=>'05/03/2025'],
                    ['id'=>'T004','nama'=>'Lim Mei Ling','semasa'=>'Johor','dipohon'=>'Negeri Sembilan','tarikh'=>'01/03/2025'],
                    ['id'=>'T005','nama'=>'Azman bin Aziz','semasa'=>'Selangor','dipohon'=>'Negeri Sembilan','tarikh'=>'25/02/2025'],
                    ['id'=>'T006','nama'=>'Nurul Huda binti Ismail','semasa'=>'Johor','dipohon'=>'Melaka','tarikh'=>'20/02/2025'],
                    ['id'=>'T007','nama'=>'Jason Wong','semasa'=>'Pulau Pinang','dipohon'=>'Kedah','tarikh'=>'15/02/2025'],
                    ['id'=>'T008','nama'=>'Aini binti Yusof','semasa'=>'Kedah','dipohon'=>'Perlis','tarikh'=>'10/02/2025'],
                ];
            @endphp

            <div class="p-2 md:p-4 overflow-x-auto">
                <table class="w-full text-sm table-auto">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3 w-[90px]">ID</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3 w-[160px]">Negeri Semasa</th>
                            <th class="p-3 w-[160px]">Negeri Dipohon</th>
                            <th class="p-3 w-[150px]">Tarikh Mohon</th>
                            <th class="p-3 w-[190px]">Status</th>
                            <th class="p-3 w-[160px]">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tukarNegeri as $t)
                        <tr class="border-b border-[#BAC4F7]/60">
                            <td class="p-3">{{ $t['id'] }}</td>
                            <td class="p-3">{{ $t['nama'] }}</td>
                            <td class="p-3">{{ $t['semasa'] }}</td>
                            <td class="p-3">{{ $t['dipohon'] }}</td>
                            <td class="p-3">{{ $t['tarikh'] }}</td>
                            <td class="p-3">
                                <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-800 px-3 py-1 text-xs font-medium">
                                    Menunggu Kelulusan
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="flex items-center gap-2">
                                    <button class="px-3 py-1 text-xs rounded-md bg-green-100 text-green-700 hover:bg-green-200">
                                        Lulus
                                    </button>
                                    <button class="px-3 py-1 text-xs rounded-md bg-red-100 text-red-600 hover:bg-red-200">
                                        Tolak
                                    </button>
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
