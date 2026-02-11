@extends('layouts.app')

@section('title', 'Laporan - HQ')

@section('content')
@php
    $tahunMin = $tahunMin ?? (int) date('Y');
    $tahunMax = $tahunMax ?? (int) date('Y');
    $tahunPilih = $tahunPilih ?? (string) $tahunMax;
@endphp
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10 space-y-6"
     x-data="{ tab: 'tahunan', tahun: '{{ $tahunPilih }}' }">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold">Laporan</h1>
        <p class="text-sm text-gray-600">Laporan dan statistik keahlian Alumni 4B Malaysia berdasarkan data sistem.</p>
    </div>

    {{-- Tahun Dropdown --}}
    <form method="get" action="{{ route('hq.laporan') }}" class="max-w-sm" id="tahunForm">
        <label class="block text-xs font-medium text-gray-700 mb-2">Tahun</label>
        <div class="relative">
            <select name="tahun" x-model="tahun" @change="$el.form.submit()"
                    class="w-full rounded-md border border-[#BAC4F7] px-3 py-2 pr-10 text-sm bg-white focus:border-primary focus:ring-1 focus:ring-primary">
                @for ($y = $tahunMin; $y <= $tahunMax; $y++)
                <option value="{{ $y }}" {{ $tahunPilih == (string)$y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>

            {{-- dropdown icon --}}
            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </div>
    </form>

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
                <p class="text-sm text-gray-500 mt-1">Statistik keahlian disahkan Alumni 4B Malaysia mengikut tahun (data dari sistem).</p>
            </div>

            {{-- Laporan mengikut bulan (tahun yang dipilih) --}}
            @php $laporanBulanan = $laporanBulanan ?? []; @endphp
            <div class="p-6 border-b border-[#BAC4F7]/60">
                <h3 class="font-semibold text-base mb-2">Laporan Mengikut Bulan (Tahun {{ $tahunPilih ?? date('Y') }})</h3>
                <p class="text-sm text-gray-500 mb-4">Ahli baru diluluskan mengikut bulan untuk tahun yang dipilih.</p>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm max-w-xl">
                        <thead class="text-left border-b border-[#BAC4F7]">
                            <tr>
                                <th class="p-3">Bulan</th>
                                <th class="p-3 w-[140px]">Ahli Baru</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporanBulanan as $row)
                                <tr class="border-b border-[#BAC4F7]/60">
                                    <td class="p-3">{{ $row['nama_bulan'] }}</td>
                                    <td class="p-3">
                                        <span class="text-green-600 font-medium">{{ number_format($row['jumlah']) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @php $laporan = $laporan ?? []; @endphp
            <div class="p-4">
                <h3 class="font-semibold text-base mb-2">Ringkasan Tahunan (Kumulatif)</h3>
            </div>
            <div class="p-2 md:p-4 overflow-x-auto">
                @if(empty($laporan))
                    <div class="p-8 text-center text-gray-500">Tiada data keahlian disahkan dalam sistem.</div>
                @else
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
                @endif
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

            @php $demografi = $demografi ?? []; @endphp

            <div class="p-2 md:p-4 overflow-x-auto">
                @if(empty($demografi))
                    <div class="p-8 text-center text-gray-500">
                        Tiada data kaum dalam sistem. Medan kaum tidak wujud dalam borang keahlian semasa.
                    </div>
                @else
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
                @endif
            </div>

        </div>


        {{-- TAB: STATISTIK NEGERI --}}
        <div x-show="tab==='negeri'" x-cloak>

            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="text-lg font-semibold">Statistik Negeri</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Statistik keahlian disahkan Alumni 4B Malaysia mengikut negeri (data dari sistem).
                </p>
            </div>

            @php
                $jumlahNegeri = $jumlahNegeri ?? [];
                $baruByNegeri = $baruByNegeri ?? [];
                $maxJumlah = !empty($jumlahNegeri) ? max(array_column($jumlahNegeri, 'jumlah')) : 0;
                $maxBaru = !empty($baruByNegeri) ? max(array_column($baruByNegeri, 'jumlah')) : 0;
            @endphp

            <div class="p-6">
                @if(empty($jumlahNegeri) && empty($baruByNegeri))
                    <div class="py-8 text-center text-gray-500">Tiada data keahlian disahkan dalam sistem.</div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    {{-- LEFT: Jumlah ahli mengikut negeri --}}
                    <div>
                        <h3 class="font-semibold mb-4">Jumlah Ahli Mengikut Negeri</h3>

                        @if(empty($jumlahNegeri))
                            <p class="text-sm text-gray-500">Tiada data.</p>
                        @else
                        <div class="space-y-4">
                            @foreach($jumlahNegeri as $n)
                                @php $pct = $maxJumlah > 0 ? ($n['jumlah'] / $maxJumlah) * 100 : 0; @endphp

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
                        @endif
                    </div>

                    {{-- RIGHT: Ahli baru tahun pilih --}}
                    <div>
                        <h3 class="font-semibold mb-4">Ahli Baru Tahun {{ $tahunPilih ?? date('Y') }}</h3>

                        @if(empty($baruByNegeri))
                            <p class="text-sm text-gray-500">Tiada ahli baru tahun ini.</p>
                        @else
                        <div class="space-y-4">
                            @foreach($baruByNegeri as $n)
                                @php $pct = $maxBaru > 0 ? ($n['jumlah'] / $maxBaru) * 100 : 0; @endphp

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
                        @endif
                    </div>

                </div>
                @endif
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

            @php $tukarNegeri = $tukarNegeri ?? []; @endphp

            <div class="p-2 md:p-4 overflow-x-auto">
                @if(empty($tukarNegeri))
                    <div class="p-8 text-center text-gray-500">
                        Tiada permohonan tukar negeri dalam sistem. Fungsi tukar negeri belum diimplementasikan.
                    </div>
                @else
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
                @endif
            </div>

        </div>


    </div>
</div>
@endsection
