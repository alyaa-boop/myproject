@extends('layouts.app')

@section('title', 'Senarai Ahli - HQ')

@section('content')
@push('styles')
<style>
@media print {
    header, footer, .no-print, nav, .flex.gap-2, button, a { display: none !important; }
    .print-header { display: block !important; margin-bottom: 1rem; }
    body { padding: 16px; }
}
.print-header { display: none; }
</style>
@endpush

<div class="print-header">
    <h1 style="font-size: 1.5rem; font-weight: bold; margin: 0;">Senarai Ahli - {{ $stateLabel }}</h1>
    <p style="margin: 0.25rem 0 0 0; color: #666;">Dicetak pada {{ date('d/m/Y H:i') }}</p>
</div>

<div class="max-w-7xl mx-auto px-4 mt-6 mb-10" x-data="membersListPage()">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row justify-between gap-4 md:items-center no-print">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Senarai Ahli</h1>
            <p class="text-gray-600">Senarai ahli {{ $stateLabel }}. Jumlah ahli: {{ $ahli->count() }}</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('hq.dashboard') }}"
               class="inline-flex items-center gap-2 rounded-md border border-[#BAC4F7] px-3 py-2 text-sm hover:bg-gray-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>

            <button type="button"
               class="inline-flex items-center gap-2 rounded-md border border-[#BAC4F7] px-3 py-2 text-sm hover:bg-gray-50"
               @click="printPdf()">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l4-4m-4 4l-4-4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 17v3h16v-3"/>
                </svg>
                Muat Turun (PDF)
            </button>
        </div>
    </div>

    {{-- Card --}}
    <div class="mt-6 border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">
        <div class="p-6 border-b border-[#BAC4F7] no-print">
            <h2 class="text-lg font-semibold">Senarai Ahli</h2>
            <p class="text-sm text-gray-600 mt-1">
                Senarai ahli {{ $stateLabel }}. Jumlah ahli: {{ $ahli->count() }}
            </p>
        </div>

        <div class="p-6">
            {{-- Filters --}}
            <form method="GET" action="{{ route('hq.senarai-ahli') }}" class="flex flex-col md:flex-row gap-4 mb-6 no-print">
                <div class="flex-1">
                    <label for="search" class="sr-only">Carian</label>
                    <div class="relative">
                        <span class="absolute left-2.5 top-2.5 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input id="search" name="q" type="search" placeholder="Cari mengikut nama, no. ahli, atau no. kad pengenalan..."
                            value="{{ request('q') }}"
                            class="w-full rounded-md border border-[#BAC4F7] pl-8 pr-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"/>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="rounded-md border border-[#BAC4F7] px-4 py-2 text-sm hover:bg-gray-50">Cari</button>
                    @if(request('q'))
                        <a href="{{ route('hq.senarai-ahli') }}" class="rounded-md border border-[#BAC4F7] px-4 py-2 text-sm hover:bg-gray-50">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto" id="printable-area">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#BAC4F7]">
                            <th class="text-left font-medium p-2">No. Ahli</th>
                            <th class="text-left font-medium p-2">Nama</th>
                            <th class="text-left font-medium p-2">No. Kad Pengenalan</th>
                            <th class="text-left font-medium p-2">Tarikh Daftar</th>
                            <th class="text-left font-medium p-2">Status</th>
                            <th class="text-left font-medium p-2 no-print">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ahli as $a)
                        <tr class="border-b border-[#BAC4F7]/60"
                            data-no-ahli="{{ $a->no_ahli }}"
                            data-name="{{ $a->name }} ({{ $a->nama_negeri }})"
                            data-ic-number="{{ $a->ic_number }}"
                            data-date-registered="{{ $a->updated_at->format('d/m/Y') }}">
                            <td class="p-2">{{ $a->no_ahli }}</td>
                            <td class="p-2">{{ $a->name }} ({{ $a->nama_negeri }})</td>
                            <td class="p-2">{{ $a->ic_number }}</td>
                            <td class="p-2">{{ $a->updated_at->format('d/m/Y') }}</td>
                            <td class="p-2">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                            </td>
                            <td class="p-2 no-print">
                                <button type="button" class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100" @click="viewCardFromRow($event)">
                                    Lihat Kad
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">
                                {{ request('q') ? 'Tiada hasil carian ditemui' : 'Tiada ahli berdaftar' }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Lihat Kad --}}
    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4 no-print"
         @keydown.escape.window="modalOpen=false" @click.self="modalOpen=false">
        <div class="w-full max-w-lg rounded-lg bg-white border border-[#BAC4F7] overflow-hidden">
            <div class="p-4 border-b border-[#BAC4F7] flex items-center justify-between">
                <div class="font-semibold">Maklumat Ahli</div>
                <button class="p-2 hover:bg-gray-100 rounded" @click="modalOpen=false" aria-label="Close">✕</button>
            </div>
            <div class="p-4 space-y-2 text-sm" x-show="selected">
                <div><span class="text-gray-500">No. Ahli:</span> <span class="font-medium" x-text="selected?.id"></span></div>
                <div><span class="text-gray-500">Nama:</span> <span class="font-medium" x-text="selected?.name"></span></div>
                <div><span class="text-gray-500">No. Kad Pengenalan:</span> <span class="font-medium" x-text="selected?.icNumber"></span></div>
                <div><span class="text-gray-500">Tarikh Daftar:</span> <span class="font-medium" x-text="selected?.dateRegistered"></span></div>
                <div><span class="text-gray-500">Status:</span> <span class="font-medium" x-text="selected?.status"></span></div>
                <div class="mt-4 rounded-md border border-dashed p-4 text-gray-500 text-center">(Kad keahlian digital)</div>
            </div>
            <div class="p-4 border-t border-[#BAC4F7] flex justify-end">
                <button class="rounded-md border border-[#BAC4F7] px-4 py-2 text-sm hover:bg-gray-50" @click="modalOpen=false">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function membersListPage() {
    return {
        modalOpen: false,
        selected: null,

        viewCardFromRow(ev) {
            const tr = ev.target.closest('tr');
            if (!tr || !tr.dataset.noAhli) return;
            this.selected = {
                id: tr.dataset.noAhli,
                name: tr.dataset.name,
                icNumber: tr.dataset.icNumber,
                dateRegistered: tr.dataset.dateRegistered,
                status: 'Aktif'
            };
            this.modalOpen = true;
        },

        printPdf() { window.print(); }
    }
}
</script>
@endpush
@endsection
