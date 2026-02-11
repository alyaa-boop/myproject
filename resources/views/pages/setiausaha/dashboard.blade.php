@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-6 space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Dashboard Setiausaha</h1>
            <p class="text-sm text-gray-600">Selamat datang ke portal pengurusan Alumni 4B {{ $stateLabel ?? 'Alumni 4B' }}.</p>
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

            <a href="{{ route('pengesahan') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-red-500 rounded-md hover:bg-red-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>
                Pengesahan
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @php
            $cards = [
                ['title'=>'Dihantar ke HQ','value'=> $countMenungguHq ?? 0,'desc'=>'Menunggu kelulusan HQ'],
                ['title'=>'Menunggu Pengesahan','value'=> $countMenunggu ?? 0,'desc'=>'Permohonan belum disahkan'],
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
                Dihantar ke HQ
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
                            @forelse($menunggu ?? [] as $k)
                                <tr class="border-b border-[#BAC4F7]/60">
                                    <td class="p-3">P{{ str_pad($k->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $k->name }} ({{ $k->nama_negeri }})</td>
                                    <td>{{ $k->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">Menunggu Pengesahan</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('keahlian.sahkan', $k->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-xs border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50">Sahkan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-500">Tiada permohonan menunggu pengesahan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="p-4 text-center">
                        <a href="{{ route('pengesahan') }}" class="px-4 py-2 text-sm border rounded-md hover:bg-gray-50 inline-block">
                            Lihat Semua Permohonan
                        </a>
                    </div>
                </div>
            </div>

            {{-- DIHANTAR KE HQ --}}
            <div x-show="tab === 'terkini'" x-cloak>
                <div class="p-6">
                    <h2 class="text-2xl font-bold">Dihantar ke HQ</h2>
                    <p class="text-sm text-gray-600 mt-1">Senarai permohonan yang telah disahkan dan menunggu kelulusan HQ.</p>

                    <div class="mt-6 overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="text-left border-b border-[#BAC4F7]">
                                <tr>
                                    <th class="py-3 pr-4 w-[100px]">ID</th>
                                    <th class="py-3 pr-4">Nama</th>
                                    <th class="py-3 pr-4 w-[160px]">Tarikh</th>
                                    <th class="py-3 w-[140px]">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($menungguHq ?? [] as $a)
                                    <tr class="border-b border-[#BAC4F7]/60">
                                        <td class="py-4 pr-4 font-medium">P{{ str_pad($a->id, 3, '0', STR_PAD_LEFT) }}</td>
                                        <td class="py-4 pr-4">{{ $a->name }} ({{ $a->nama_negeri }})</td>
                                        <td class="py-4 pr-4">{{ $a->updated_at->format('d/m/Y') }}</td>
                                        <td class="py-4">
                                            <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-700 px-3 py-1 text-xs font-medium">Menunggu HQ</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="py-6 text-center text-gray-500">Tiada permohonan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 flex justify-center">
                        <a href="{{ route('pengesahan') }}" class="inline-flex items-center justify-center rounded-md border border-[#BAC4F7] px-6 py-2 text-sm font-medium hover:bg-gray-50">
                            Lihat Semua
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
