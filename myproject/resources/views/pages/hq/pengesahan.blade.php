@extends('layouts.app')

@section('title', 'Pengesahan Keahlian - HQ')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10 space-y-6"
     x-data="{
        tab: 'menunggu',
        q: ''
     }">

    {{-- Header --}}
    <div class="text-center">
        <h1 class="text-2xl font-bold">Pengesahan Keahlian</h1>
        <p class="text-sm text-gray-600 mt-1">Senarai permohonan keahlian yang menunggu nombor ahli.</p>
    </div>

    {{-- Search --}}
    <div class="max-w-5xl mx-auto">
        <label class="block text-xs font-medium text-gray-600 mb-2">Carian</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                {{-- search icon --}}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3"/>
                    <circle cx="11" cy="11" r="7"/>
                </svg>
            </span>
            <input
                type="text"
                x-model="q"
                placeholder="Cari mengikut nama, ID, atau negeri..."
                class="w-full rounded-md border border-[#BAC4F7] px-9 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
            />
        </div>

        {{-- Tabs --}}
        <div class="mt-3 inline-flex bg-[#EEF1FF] rounded-md p-1 gap-1">
            <button
                @click="tab='menunggu'"
                :class="tab==='menunggu' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-3 py-1.5 text-xs font-medium rounded-md transition"
            >
                Menunggu No. Ahli (12)
            </button>

            <button
                @click="tab='diluluskan'"
                :class="tab==='diluluskan' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-3 py-1.5 text-xs font-medium rounded-md transition"
            >
                Baru Diluluskan (8)
            </button>
        </div>
    </div>

    {{-- Card --}}
    <div class="max-w-5xl mx-auto border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">

        {{-- MENUNGGU NO. AHLI --}}
        <div x-show="tab==='menunggu'" x-cloak>
            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="font-semibold">Permohonan Menunggu No. Ahli</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Senarai permohonan keahlian yang telah disahkan oleh Setiausaha Negeri dan menunggu nombor ahli.
                </p>
            </div>

            @php
                $rowsMenunggu = [
                    ['id'=>'P001','nama'=>'Azman bin Aziz','tarikh'=>'15/03/2025','negeri'=>'Selangor'],
                    ['id'=>'P002','nama'=>'Nurul Huda binti Ismail','tarikh'=>'14/03/2025','negeri'=>'Johor'],
                    ['id'=>'P003','nama'=>'Jason Wong','tarikh'=>'12/03/2025','negeri'=>'Pulau Pinang'],
                    ['id'=>'P004','nama'=>'Aini binti Yusof','tarikh'=>'10/03/2025','negeri'=>'Kedah'],
                    ['id'=>'P005','nama'=>'Muthu a/l Selvan','tarikh'=>'08/03/2025','negeri'=>'Perak'],
                    ['id'=>'P006','nama'=>'Zarina binti Zakaria','tarikh'=>'05/03/2025','negeri'=>'Terengganu'],
                    ['id'=>'P007','nama'=>'Chong Kok Wai','tarikh'=>'03/03/2025','negeri'=>'Melaka'],
                    ['id'=>'P008','nama'=>'Noraini binti Hamzah','tarikh'=>'01/03/2025','negeri'=>'Pahang'],
                    ['id'=>'P009','nama'=>'Saiful bin Bahari','tarikh'=>'28/02/2025','negeri'=>'Kelantan'],
                    ['id'=>'P010','nama'=>'Teresa Lim','tarikh'=>'25/02/2025','negeri'=>'Negeri Sembilan'],
                    ['id'=>'P011','nama'=>'Ganesh a/l Murthy','tarikh'=>'22/02/2025','negeri'=>'Perlis'],
                    ['id'=>'P012','nama'=>'Siti Aminah binti Ali','tarikh'=>'20/02/2025','negeri'=>'WP Kuala Lumpur'],
                ];
            @endphp

            <div class="p-2 md:p-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3 w-[90px]">ID</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3 w-[160px]">Tarikh Mohon</th>
                            <th class="p-3 w-[160px]">Negeri</th>
                            <th class="p-3 w-[180px]">Status</th>
                            <th class="p-3 w-[170px]">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($rowsMenunggu as $r)
                        <tr class="border-b border-[#BAC4F7]/60"
                            x-show="
                                q === '' ||
                                '{{ $r['id'] }}'.toLowerCase().includes(q.toLowerCase()) ||
                                '{{ $r['nama'] }}'.toLowerCase().includes(q.toLowerCase()) ||
                                '{{ $r['negeri'] }}'.toLowerCase().includes(q.toLowerCase())
                            ">
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
            </div>
        </div>

        {{-- BARU DILULUSKAN --}}
        <div x-show="tab==='diluluskan'" x-cloak>
            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="font-semibold">Permohonan Baru Diluluskan</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Senarai permohonan keahlian yang baru diluluskan dan diberi nombor ahli.
                </p>
            </div>

            @php
                $baruDiluluskan = [
                    ['no'=>'A12345','nama'=>'Ahmad bin Abdullah','tarikh'=>'01/03/2025','negeri'=>'Selangor'],
                    ['no'=>'A12346','nama'=>'Siti binti Hassan','tarikh'=>'28/02/2025','negeri'=>'Johor'],
                    ['no'=>'A12347','nama'=>'Ravi a/l Chandran','tarikh'=>'25/02/2025','negeri'=>'Pulau Pinang'],
                    ['no'=>'A12348','nama'=>'Lim Mei Ling','tarikh'=>'20/02/2025','negeri'=>'Sabah'],
                    ['no'=>'A12349','nama'=>'Abdul Rahim bin Ismail','tarikh'=>'15/02/2025','negeri'=>'Johor'],
                    ['no'=>'A12350','nama'=>'Norhayati binti Hassan','tarikh'=>'10/02/2025','negeri'=>'Kedah'],
                    ['no'=>'A12351','nama'=>'Mohd Fadzli bin Abdullah','tarikh'=>'05/02/2025','negeri'=>'Kelantan'],
                    ['no'=>'A12352','nama'=>'Lim Siew Mei','tarikh'=>'01/02/2025','negeri'=>'Melaka'],
                ];
            @endphp

            <div class="p-2 md:p-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left border-b border-[#BAC4F7]">
                        <tr>
                            <th class="p-3 w-[140px]">No. Ahli</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3 w-[160px]">Tarikh Daftar</th>
                            <th class="p-3 w-[160px]">Negeri</th>
                            <th class="p-3 w-[140px]">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($baruDiluluskan as $a)
                        <tr class="border-b border-[#BAC4F7]/60"
                            x-show="
                                q === '' ||
                                '{{ $a['no'] }}'.toLowerCase().includes(q.toLowerCase()) ||
                                '{{ $a['nama'] }}'.toLowerCase().includes(q.toLowerCase()) ||
                                '{{ $a['negeri'] }}'.toLowerCase().includes(q.toLowerCase())
                            ">
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


    </div>
</div>
@endsection
