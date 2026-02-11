@extends('layouts.app')

@section('title', 'Pengesahan Keahlian')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10 space-y-6"
     x-data="pengesahanPage()">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold">Pengesahan Keahlian</h1>
        <p class="text-sm text-gray-600">
            Senarai permohonan keahlian yang menunggu pengesahan untuk negeri Johor.
        </p>
    </div>

    {{-- Search --}}
    <div class="space-y-2">
        <label class="text-sm font-medium text-gray-700">Carian</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                {{-- search icon --}}
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input
                type="text"
                x-model="q"
                placeholder="Cari mengikut nama atau ID..."
                class="w-full rounded-md border border-[#BAC4F7] px-10 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
            />
        </div>
    </div>

    {{-- Tabs --}}
    <div class="inline-flex bg-[#EEF1FF] rounded-md p-1 gap-1">
        <button
            @click="tab='menunggu'"
            :class="tab==='menunggu' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
            class="px-3 py-2 text-sm font-medium rounded-md transition"
        >
            Menunggu Pengesahan <span class="ml-1 text-xs text-gray-500" x-text="filteredMenunggu.length"></span>
        </button>

        <button
            @click="tab='disahkan'"
            :class="tab==='disahkan' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
            class="px-3 py-2 text-sm font-medium rounded-md transition"
        >
            Disahkan <span class="ml-1 text-xs text-gray-500" x-text="filteredDisahkan.length"></span>
        </button>

        <button
            @click="tab='aktif'"
            :class="tab==='aktif' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
            class="px-3 py-2 text-sm font-medium rounded-md transition"
        >
            Aktif <span class="ml-1 text-xs text-gray-500" x-text="filteredAktif.length"></span>
        </button>
    </div>

    {{-- Card + Table --}}
    <div class="border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">

        {{-- Card Header --}}
        <div class="p-6 border-b border-[#BAC4F7]">
            <h2 class="font-semibold"
                x-text="tab === 'menunggu' ? 'Permohonan Menunggu Pengesahan' : (tab === 'disahkan' ? 'Permohonan Disahkan' : 'Ahli Aktif')">
            </h2>

            <p class="text-sm text-gray-500 mt-1"
               x-text="tab === 'menunggu'
                    ? 'Senarai permohonan keahlian yang menunggu pengesahan anda.'
                    : (tab === 'disahkan'
                        ? 'Senarai permohonan yang telah disahkan.'
                        : 'Senarai ahli aktif.')">
            </p>
        </div>

        <div class="p-2 md:p-4 overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-left border-b border-[#BAC4F7]">
                    <tr>
                        <th class="p-3 w-[90px]">ID</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3 w-[140px]">Tarikh Mohon</th>
                        <th class="p-3 w-[160px]">Status</th>
                        <th class="p-3 w-[220px]">Tindakan</th>
                    </tr>
                </thead>

                {{-- MENUNGGU --}}
                <tbody x-show="tab==='menunggu'" x-cloak>
                    <template x-for="row in filteredMenunggu" :key="row.id">
                        <tr class="border-b border-[#BAC4F7]/60">
                            <td class="p-3" x-text="row.id"></td>
                            <td class="p-3" x-text="row.nama"></td>
                            <td class="p-3" x-text="row.tarikh"></td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                                    Menunggu Pengesahan
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="flex items-center gap-2">
                                    <button class="px-3 py-1 text-xs border rounded-md hover:bg-gray-50">Lihat</button>
                                    <button class="px-3 py-1 text-xs border border-green-600 text-green-700 bg-green-50 rounded-md hover:bg-green-100">
                                        Sahkan
                                    </button>
                                    <button class="px-3 py-1 text-xs border border-red-500 text-red-600 bg-red-50 rounded-md hover:bg-red-100">
                                        Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>

                    <tr x-show="filteredMenunggu.length === 0">
                        <td colspan="5" class="p-6 text-center text-sm text-gray-500">
                            Tiada rekod ditemui.
                        </td>
                    </tr>
                </tbody>

                {{-- DISAHKAN --}}
                <tbody x-show="tab==='disahkan'" x-cloak>
                    <template x-for="row in filteredDisahkan" :key="row.id">
                        <tr class="border-b border-[#BAC4F7]/60">
                            <td class="p-3" x-text="row.id"></td>
                            <td class="p-3" x-text="row.nama"></td>
                            <td class="p-3" x-text="row.tarikh"></td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                    Disahkan
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="flex items-center gap-2">
                                    <button class="px-3 py-1 text-xs border rounded-md hover:bg-gray-50">Lihat</button>
                                </div>
                            </td>
                        </tr>
                    </template>

                    <tr x-show="filteredDisahkan.length === 0">
                        <td colspan="5" class="p-6 text-center text-sm text-gray-500">
                            Tiada rekod ditemui.
                        </td>
                    </tr>
                </tbody>

                {{-- AKTIF --}}
                <tbody x-show="tab==='aktif'" x-cloak>
                    <template x-for="row in filteredAktif" :key="row.id">
                        <tr class="border-b border-[#BAC4F7]/60">
                            <td class="p-3" x-text="row.id"></td>
                            <td class="p-3" x-text="row.nama"></td>
                            <td class="p-3" x-text="row.tarikh"></td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                                    Aktif
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="flex items-center gap-2">
                                    <button class="px-3 py-1 text-xs border rounded-md hover:bg-gray-50">Lihat</button>
                                </div>
                            </td>
                        </tr>
                    </template>

                    <tr x-show="filteredAktif.length === 0">
                        <td colspan="5" class="p-6 text-center text-sm text-gray-500">
                            Tiada rekod ditemui.
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
function pengesahanPage() {
    const menunggu = [
        { id: 'P001', nama: 'Azman bin Aziz (Johor)', tarikh: '15/03/2025' },
        { id: 'P002', nama: 'Nurul Huda binti Ismail (Johor)', tarikh: '14/03/2025' },
        { id: 'P003', nama: 'Jason Wong (Johor)', tarikh: '12/03/2025' },
        { id: 'P004', nama: 'Aini binti Yusof (Johor)', tarikh: '10/03/2025' },
        { id: 'P005', nama: 'Muthu a/l Selvan (Johor)', tarikh: '08/03/2025' },
    ];

    const disahkan = [
        { id: 'A12345', nama: 'Ahmad bin Abdullah (Johor)', tarikh: '01/03/2025' },
        { id: 'A12346', nama: 'Siti binti Hassan (Johor)', tarikh: '28/02/2025' },
        { id: 'A12347', nama: 'Ravi a/l Chandran (Johor)', tarikh: '25/02/2025' },
        { id: 'A12348', nama: 'Lim Mei Ling (Johor)', tarikh: '20/02/2025' },
    ];

    const aktif = [
        { id: 'A12001', nama: 'Ali bin Omar (Johor)', tarikh: '11/02/2025' },
        { id: 'A12002', nama: 'Farah binti Zain (Johor)', tarikh: '05/02/2025' },
        { id: 'A12003', nama: 'Kumar a/l Raj (Johor)', tarikh: '29/01/2025' },
        { id: 'A12004', nama: 'Chong Wei (Johor)', tarikh: '20/01/2025' },
    ];

    return {
        tab: 'menunggu',
        q: '',
        menunggu,
        disahkan,
        aktif,

        get filteredMenunggu() {
            const q = this.q.trim().toLowerCase();
            if (!q) return this.menunggu;
            return this.menunggu.filter(r =>
                r.id.toLowerCase().includes(q) || r.nama.toLowerCase().includes(q)
            );
        },
        get filteredDisahkan() {
            const q = this.q.trim().toLowerCase();
            if (!q) return this.disahkan;
            return this.disahkan.filter(r =>
                r.id.toLowerCase().includes(q) || r.nama.toLowerCase().includes(q)
            );
        },
        get filteredAktif() {
            const q = this.q.trim().toLowerCase();
            if (!q) return this.aktif;
            return this.aktif.filter(r =>
                r.id.toLowerCase().includes(q) || r.nama.toLowerCase().includes(q)
            );
        },
    }
}
</script>
@endpush
@endsection
