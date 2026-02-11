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
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>
                Pengesahan
                <span class="ml-1 inline-flex items-center justify-center rounded-full bg-white/20 px-2 py-0.5 text-xs">
                    {{ $countMenungguHq ?? 0 }}
                </span>
            </a>

            <a href="{{ route('hq.laporan') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-primary rounded-md hover:bg-primary/90 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
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
            ['title'=>'Jumlah Ahli','value'=> $totalAhli ?? 0,'desc'=>'Ahli diluluskan di seluruh Malaysia'],
            ['title'=>'Menunggu No. Ahli','value'=> $countMenungguHq ?? 0,'desc'=>'Permohonan dari Setiausaha menunggu kelulusan HQ'],
            ['title'=>'Baru Diluluskan','value'=> $countDiluluskan ?? 0,'desc'=>'Ahli yang telah diberi No. Ahli'],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                        @forelse($menungguHq ?? [] as $r)
                            <tr class="border-b border-[#BAC4F7]/60">
                                <td class="p-3">P{{ str_pad($r->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="p-3">{{ $r->name }}</td>
                                <td class="p-3">{{ $r->updated_at->format('d/m/Y') }}</td>
                                <td class="p-3">{{ $r->nama_negeri }}</td>
                                <td class="p-3">
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-800 px-3 py-1 text-xs font-medium">Menunggu No. Ahli</span>
                                </td>
                                <td class="p-3">
                                    <form action="{{ route('keahlian.hq.luluskan', $r->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 text-xs border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50">Beri No. Ahli</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="p-6 text-center text-gray-500">Tiada permohonan menunggu. Permohonan akan muncul di sini selepas Setiausaha meluluskan.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4 flex justify-center">
                    <a href="{{ route('hq.pengesahan') }}" class="px-4 py-2 text-sm border border-[#BAC4F7] rounded-md hover:bg-gray-50">
                        Lihat Semua Permohonan
                    </a>
                </div>
            </div>
        </div>

        {{-- AHLI TERKINI (Diluluskan HQ) --}}
        <div x-show="tab==='terkini'" x-cloak>
            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="font-semibold">Ahli Terkini (Diluluskan HQ)</h2>
                <p class="text-sm text-gray-500 mt-1">Senarai ahli yang telah diluluskan HQ dan diberi No. Ahli.</p>
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
                        @forelse($diluluskan ?? [] as $a)
                            <tr class="border-b border-[#BAC4F7]/60">
                                <td class="p-3">{{ $a->no_ahli }}</td>
                                <td class="p-3">{{ $a->name }}</td>
                                <td class="p-3">{{ $a->updated_at->format('d/m/Y') }}</td>
                                <td class="p-3">{{ $a->nama_negeri }}</td>
                                <td class="p-3">
                                    <span class="inline-flex items-center rounded-full bg-green-100 text-green-700 px-3 py-1 text-xs font-medium">Aktif</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-6 text-center text-gray-500">Tiada rekod. Rekod akan muncul selepas HQ meluluskan permohonan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 flex justify-center">
                <a href="{{ route('hq.pengesahan') }}" class="px-4 py-2 text-sm border border-[#BAC4F7] rounded-md hover:bg-gray-50">
                    Lihat Semua
                </a>
            </div>
        </div>


        {{-- STATISTIK NEGERI --}}
        <div x-show="tab==='statistik'" x-cloak>
            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="font-semibold">Statistik Ahli Mengikut Negeri</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Jumlah ahli diluluskan mengikut negeri.
                </p>
            </div>

            <div class="p-2 md:p-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3 w-[220px]">Negeri</th>
                            <th class="p-3 w-[160px]">Jumlah Ahli</th>
                            <th class="p-3">Peratusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $negeriNames = [
                                'johor'=>'Johor','kedah'=>'Kedah','kelantan'=>'Kelantan','melaka'=>'Melaka',
                                'negeri_sembilan'=>'Negeri Sembilan','pahang'=>'Pahang','perak'=>'Perak','perlis'=>'Perlis',
                                'pulau_pinang'=>'Pulau Pinang','sabah'=>'Sabah','sarawak'=>'Sarawak','selangor'=>'Selangor',
                                'terengganu'=>'Terengganu','wp_kuala_lumpur'=>'WP Kuala Lumpur','wp_labuan'=>'WP Labuan','wp_putrajaya'=>'WP Putrajaya',
                            ];
                            $total = $totalAhli ?? 1;
                        @endphp
                        @forelse($negeriStats ?? [] as $n)
                            <tr class="border-b border-[#BAC4F7]/60">
                                <td class="p-3">{{ $negeriNames[$n->state] ?? ucfirst($n->state) }}</td>
                                <td class="p-3">{{ number_format($n->jumlah) }}</td>
                                <td class="p-3">
                                    @php $pct = $total > 0 ? round(($n->jumlah / $total) * 100, 1) : 0; @endphp
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-2 bg-primary rounded-full" style="width: {{ $pct }}%;"></div>
                                        </div>
                                        <span class="text-xs text-gray-600 w-[40px] text-right">{{ $pct }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="p-6 text-center text-gray-500">Tiada data statistik.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
@endsection
