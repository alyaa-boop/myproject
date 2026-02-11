@extends('layouts.app')

@section('title', 'Senarai Ahli')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10"
     x-data="membersListPage()">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row justify-between gap-4 md:items-center">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Senarai Ahli</h1>
            <p class="text-gray-600">Senarai ahli Alumni 4B <span x-text="state"></span>.</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-2 rounded-md border border-[#BAC4F7] px-3 py-2 text-sm hover:bg-gray-50">
                {{-- ArrowLeft --}}
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>

            <button type="button"
               class="inline-flex items-center gap-2 rounded-md border border-[#BAC4F7] px-3 py-2 text-sm hover:bg-gray-50"
               @click="downloadCsv()">
                {{-- Download --}}
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l4-4m-4 4l-4-4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 17v3h16v-3"/>
                </svg>
                Muat Turun
            </button>
        </div>
    </div>

    {{-- Card --}}
    <div class="mt-6 border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">
        <div class="p-6 border-b border-[#BAC4F7]">
            <h2 class="text-lg font-semibold">Senarai Ahli</h2>
            <p class="text-sm text-gray-600 mt-1">
                Senarai ahli Alumni 4B <span x-text="state"></span>. Jumlah ahli: <span class="font-medium" x-text="members.length"></span>
            </p>
        </div>

        <div class="p-6">

            {{-- Filters --}}
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <label for="search" class="sr-only">Carian</label>
                    <div class="relative">
                        <span class="absolute left-2.5 top-2.5 text-gray-400">
                            {{-- Search --}}
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input
                            id="search"
                            type="search"
                            placeholder="Cari mengikut nama, no. ahli, atau no. kad pengenalan..."
                            class="w-full rounded-md border border-[#BAC4F7] pl-8 pr-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                            x-model="searchQuery"
                        />
                    </div>
                </div>

                <div class="w-full md:w-[200px]">
                    <label for="status" class="sr-only">Status</label>
                    <select
                        id="status"
                        class="w-full rounded-md border border-[#BAC4F7] px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                        x-model="statusFilter"
                    >
                        <option value="all">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="tamat tempoh">Tamat Tempoh</option>
                    </select>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#BAC4F7]">
                            <th class="text-left font-medium p-2">No. Ahli</th>
                            <th class="text-left font-medium p-2">Nama</th>
                            <th class="text-left font-medium p-2">No. Kad Pengenalan</th>
                            <th class="text-left font-medium p-2">Tarikh Daftar</th>
                            <th class="text-left font-medium p-2">Status</th>
                            <th class="text-left font-medium p-2">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <template x-if="filteredMembers.length > 0">
                            <template x-for="m in paginatedMembers" :key="m.id">
                                <tr class="border-b border-[#BAC4F7]/60">
                                    <td class="p-2" x-text="m.id"></td>
                                    <td class="p-2" x-text="m.name"></td>
                                    <td class="p-2" x-text="m.icNumber"></td>
                                    <td class="p-2" x-text="m.dateRegistered"></td>

                                    <td class="p-2">
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                                            :class="m.status.toLowerCase() === 'aktif'
                                                ? 'bg-green-100 text-green-800'
                                                : 'bg-yellow-100 text-yellow-800'"
                                            x-text="m.status"
                                        ></span>
                                    </td>

                                    <td class="p-2">
                                        <button
                                            class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100"
                                            title="Lihat maklumat dan kad keahlian digital"
                                            @click="viewCard(m)"
                                        >
                                            Lihat Kad
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </template>

                        <template x-if="filteredMembers.length === 0">
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">
                                    <span x-text="(searchQuery || statusFilter !== 'all') ? 'Tiada hasil carian ditemui' : 'Tiada ahli berdaftar'"></span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            {{-- Footer pagination row (like React) --}}
            <template x-if="filteredMembers.length > 0">
                <div class="flex items-center justify-between mt-4">
                    <div class="text-sm text-gray-500">
                        Memaparkan <span class="font-medium" x-text="paginatedMembers.length"></span>
                        daripada <span class="font-medium" x-text="members.length"></span> ahli
                    </div>

                    <div class="flex gap-1">
                        <button
                            class="inline-flex items-center justify-center rounded-md border border-[#BAC4F7] px-3 py-2 text-sm hover:bg-gray-50 disabled:opacity-50"
                            :disabled="page === 1"
                            @click="page = Math.max(1, page - 1)"
                        >
                            Sebelumnya
                        </button>

                        <button
                            class="inline-flex items-center justify-center rounded-md border border-[#BAC4F7] px-3 py-2 text-sm hover:bg-gray-50 disabled:opacity-50"
                            :disabled="page === totalPages"
                            @click="page = Math.min(totalPages, page + 1)"
                        >
                            Seterusnya
                        </button>
                    </div>
                </div>
            </template>

        </div>
    </div>

    {{-- Simple modal for "Lihat Kad" (optional but matches button intent) --}}
    <div x-show="modalOpen" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4"
         @keydown.escape.window="modalOpen=false"
         @click.self="modalOpen=false">
        <div class="w-full max-w-lg rounded-lg bg-white border border-[#BAC4F7] overflow-hidden">
            <div class="p-4 border-b border-[#BAC4F7] flex items-center justify-between">
                <div class="font-semibold">Maklumat Ahli</div>
                <button class="p-2 hover:bg-gray-100 rounded" @click="modalOpen=false" aria-label="Close">
                    ✕
                </button>
            </div>
            <div class="p-4 space-y-2 text-sm">
                <div><span class="text-gray-500">No. Ahli:</span> <span class="font-medium" x-text="selected?.id"></span></div>
                <div><span class="text-gray-500">Nama:</span> <span class="font-medium" x-text="selected?.name"></span></div>
                <div><span class="text-gray-500">No. Kad Pengenalan:</span> <span class="font-medium" x-text="selected?.icNumber"></span></div>
                <div><span class="text-gray-500">Tarikh Daftar:</span> <span class="font-medium" x-text="selected?.dateRegistered"></span></div>
                <div><span class="text-gray-500">Status:</span> <span class="font-medium" x-text="selected?.status"></span></div>

                <div class="mt-4 rounded-md border border-dashed p-4 text-gray-500 text-center">
                    (Kad keahlian digital akan dipaparkan di sini kemudian)
                </div>
            </div>
            <div class="p-4 border-t border-[#BAC4F7] flex justify-end gap-2">
                <button class="rounded-md border border-[#BAC4F7] px-4 py-2 text-sm hover:bg-gray-50" @click="modalOpen=false">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
function membersListPage() {
    return {
        searchQuery: '',
        statusFilter: 'all',
        page: 1,
        perPage: 20,

        // mimic your React "state" variable
        state: 'Johor',

        modalOpen: false,
        selected: null,

        members: [
            { id:'A12345', name:'Ahmad bin Abdullah (Johor)', icNumber:'800101105421', dateRegistered:'01/01/2022', status:'Aktif' },
            { id:'A12346', name:'Siti binti Hassan (Johor)', icNumber:'810202105432', dateRegistered:'15/02/2022', status:'Aktif' },
            { id:'A12347', name:'Ravi a/l Chandran (Johor)', icNumber:'820303105443', dateRegistered:'10/03/2022', status:'Aktif' },
            { id:'A12348', name:'Lim Mei Ling (Johor)', icNumber:'830404105454', dateRegistered:'05/04/2022', status:'Aktif' },
            { id:'A12349', name:'Abdul Rahim bin Ismail (Johor)', icNumber:'840505105465', dateRegistered:'20/05/2022', status:'Aktif' },
            { id:'A12350', name:'Norhayati binti Hassan (Johor)', icNumber:'850606105476', dateRegistered:'15/06/2022', status:'Aktif' },
            { id:'A12351', name:'Mohd Fadzli bin Abdullah (Johor)', icNumber:'860707105487', dateRegistered:'10/07/2022', status:'Aktif' },
            { id:'A12352', name:'Lim Siew Mei (Johor)', icNumber:'870808105498', dateRegistered:'05/08/2022', status:'Aktif' },
            { id:'A12353', name:'Suresh a/l Kumar (Johor)', icNumber:'880909105509', dateRegistered:'20/09/2022', status:'Aktif' },
            { id:'A12354', name:'Azizah binti Yusof (Johor)', icNumber:'891010105510', dateRegistered:'15/10/2022', status:'Aktif' },
            { id:'A12355', name:'Chong Wei Liang (Johor)', icNumber:'901111105521', dateRegistered:'10/11/2022', status:'Aktif' },
            { id:'A12356', name:'Siti Aminah binti Ali (Johor)', icNumber:'911212105532', dateRegistered:'05/12/2022', status:'Aktif' },
            { id:'A12357', name:'Gopal a/l Krishnan (Johor)', icNumber:'920101105543', dateRegistered:'01/01/2023', status:'Aktif' },
            { id:'A12358', name:'Joseph Majimbun (Johor)', icNumber:'930202105554', dateRegistered:'15/02/2023', status:'Aktif' },
            { id:'A12359', name:'Jennifer Lau (Johor)', icNumber:'940303105565', dateRegistered:'10/03/2023', status:'Aktif' },
            { id:'A12360', name:'Azlan bin Aziz (Johor)', icNumber:'950404105576', dateRegistered:'05/04/2023', status:'Aktif' },
            { id:'A12361', name:'Faridah binti Ismail (Johor)', icNumber:'960505105587', dateRegistered:'20/05/2023', status:'Tamat Tempoh' },
            { id:'A12362', name:'Tan Chee Keong (Johor)', icNumber:'970606105598', dateRegistered:'15/06/2023', status:'Tamat Tempoh' },
            { id:'A12363', name:'Mariam binti Osman (Johor)', icNumber:'980707105609', dateRegistered:'10/07/2023', status:'Tamat Tempoh' },
            { id:'A12364', name:'Mohd Nazri bin Ibrahim (Johor)', icNumber:'990808105610', dateRegistered:'05/08/2023', status:'Tamat Tempoh' },
        ],

        get filteredMembers() {
            const q = this.searchQuery.trim().toLowerCase();
            const status = this.statusFilter;

            const result = this.members.filter(m => {
                const matchesSearch =
                    !q ||
                    m.name.toLowerCase().includes(q) ||
                    m.id.toLowerCase().includes(q) ||
                    m.icNumber.includes(q);

                const matchesStatus =
                    status === 'all' ||
                    m.status.toLowerCase() === status.toLowerCase();

                return matchesSearch && matchesStatus;
            });

            // keep page valid
            if (this.page > Math.max(1, Math.ceil(result.length / this.perPage))) {
                this.page = 1;
            }

            return result;
        },

        get totalPages() {
            return Math.max(1, Math.ceil(this.filteredMembers.length / this.perPage));
        },

        get paginatedMembers() {
            const start = (this.page - 1) * this.perPage;
            return this.filteredMembers.slice(start, start + this.perPage);
        },

        viewCard(member) {
            this.selected = member;
            this.modalOpen = true;
        },

        downloadCsv() {
            const header = ['No. Ahli','Nama','No. Kad Pengenalan','Tarikh Daftar','Status'];
            const data = this.filteredMembers.map(m => [
                m.id, m.name, m.icNumber, m.dateRegistered, m.status
            ]);

            const csv = [header, ...data]
                .map(row => row.map(v => `"${String(v).replaceAll('"','""')}"`).join(','))
                .join('\n');

            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);

            const a = document.createElement('a');
            a.href = url;
            a.download = 'senarai-ahli.csv';
            a.click();

            URL.revokeObjectURL(url);
        }
    }
}
</script>
@endpush
@endsection
