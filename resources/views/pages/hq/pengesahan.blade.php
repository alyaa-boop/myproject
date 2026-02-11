@extends('layouts.app')

@section('title', 'Pengesahan Keahlian - HQ')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10 space-y-6" x-data="{ tab: 'menunggu', q: '', modalOpen: false, selected: null }">

    {{-- Header --}}
    <div class="text-center">
        <h1 class="text-2xl font-bold">Pengesahan Keahlian</h1>
        <p class="text-sm text-gray-600 mt-1">Senarai permohonan keahlian yang telah disahkan Setiausaha dan menunggu kelulusan HQ.</p>
    </div>

    @if(session('success'))
    <div class="max-w-5xl mx-auto rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="max-w-5xl mx-auto rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">{{ session('error') }}</div>
    @endif

    {{-- Search --}}
    <div class="max-w-5xl mx-auto">
        <label class="block text-xs font-medium text-gray-600 mb-2">Carian</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3"/><circle cx="11" cy="11" r="7"/>
                </svg>
            </span>
            <input type="text" x-model="q" placeholder="Cari mengikut nama, ID, atau negeri..."
                class="w-full rounded-md border border-[#BAC4F7] px-9 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
            />
        </div>

        {{-- Tabs --}}
        <div class="mt-3 inline-flex bg-[#EEF1FF] rounded-md p-1 gap-1">
            <button @click="tab='menunggu'" :class="tab==='menunggu' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-3 py-1.5 text-xs font-medium rounded-md transition">
                Menunggu No. Ahli ({{ $menungguHq->count() }})
            </button>
            <button @click="tab='diluluskan'" :class="tab==='diluluskan' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
                class="px-3 py-1.5 text-xs font-medium rounded-md transition">
                Baru Diluluskan ({{ $diluluskan->count() }})
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
                        @forelse($menungguHq as $r)
                        @php
                            $kd = ['id'=>$r->id,'name'=>$r->name,'ic_number'=>$r->ic_number,'email'=>$r->email,'phone'=>$r->phone,'address'=>$r->address,'postcode'=>$r->postcode,'city'=>$r->city,'nama_negeri'=>$r->nama_negeri,'occupation'=>$r->occupation,'employer'=>$r->employer,'previous_membership_number'=>$r->previous_membership_number,'previous_membership_year'=>$r->previous_membership_year,'physical_card'=>$r->physical_card,'created_at'=>$r->created_at->format('d/m/Y')];
                        @endphp
                        <tr class="border-b border-[#BAC4F7]/60" data-keahlian="{{ base64_encode(json_encode($kd)) }}">
                            <td class="p-3">P{{ str_pad($r->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="p-3">{{ $r->name }}</td>
                            <td class="p-3">{{ $r->updated_at->format('d/m/Y') }}</td>
                            <td class="p-3">{{ $r->nama_negeri }}</td>
                            <td class="p-3">
                                <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-800 px-3 py-1 text-xs font-medium">Menunggu No. Ahli</span>
                            </td>
                            <td class="p-3">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <button type="button" @click="selected=JSON.parse(atob($el.closest('tr').getAttribute('data-keahlian'))); modalOpen=true"
                                        class="px-3 py-1.5 text-xs border border-gray-500 text-gray-700 bg-gray-50 rounded-md hover:bg-gray-100">Lihat</button>
                                    <form action="{{ route('keahlian.hq.luluskan', $r->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 text-xs border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50">
                                            Beri No. Ahli
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="p-6 text-center text-gray-500">Tiada permohonan menunggu.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- BARU DILULUSKAN --}}
        <div x-show="tab==='diluluskan'" x-cloak>
            <div class="p-6 border-b border-[#BAC4F7]">
                <h2 class="font-semibold">Permohonan Baru Diluluskan</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Senarai permohonan keahlian yang baru diluluskan dan diberi nombor ahli. Boleh semak keahlian berdasarkan No. K/P atau No. Ahli.
                </p>
            </div>

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
                        @forelse($diluluskan as $a)
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
                        <tr><td colspan="5" class="p-6 text-center text-gray-500">Tiada rekod.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Lihat Maklumat Ahli --}}
    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4"
         @keydown.escape.window="modalOpen=false" @click.self="modalOpen=false">
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-lg bg-white border border-[#BAC4F7] shadow-xl">
            <div class="p-4 border-b border-[#BAC4F7] flex items-center justify-between sticky top-0 bg-white">
                <h3 class="font-semibold text-lg">Maklumat Ahli - P<span x-text="selected ? String(selected.id).padStart(3,'0') : ''"></span></h3>
                <button type="button" class="p-2 hover:bg-gray-100 rounded" @click="modalOpen=false" aria-label="Tutup">✕</button>
            </div>
            <div class="p-6 space-y-4" x-show="selected">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div><span class="text-gray-500 block text-xs">Nama Penuh</span><span class="font-medium" x-text="selected?.name"></span></div>
                    <div><span class="text-gray-500 block text-xs">No. Kad Pengenalan</span><span class="font-medium" x-text="selected?.ic_number"></span></div>
                    <div><span class="text-gray-500 block text-xs">E-mel</span><span class="font-medium" x-text="selected?.email"></span></div>
                    <div><span class="text-gray-500 block text-xs">No. Telefon</span><span class="font-medium" x-text="selected?.phone"></span></div>
                    <div><span class="text-gray-500 block text-xs">Negeri</span><span class="font-medium" x-text="selected?.nama_negeri"></span></div>
                    <div><span class="text-gray-500 block text-xs">Tarikh Mohon</span><span class="font-medium" x-text="selected?.created_at"></span></div>
                </div>
                <div>
                    <span class="text-gray-500 block text-xs">Alamat</span>
                    <span class="font-medium" x-text="(selected?.address || '') + ', ' + (selected?.postcode || '') + ' ' + (selected?.city || '')"></span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div><span class="text-gray-500 block text-xs">Pekerjaan</span><span class="font-medium" x-text="selected?.occupation || '-'"></span></div>
                    <div><span class="text-gray-500 block text-xs">Majikan</span><span class="font-medium" x-text="selected?.employer || '-'"></span></div>
                </div>
                <template x-if="selected?.previous_membership_number || selected?.previous_membership_year">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div><span class="text-gray-500 block text-xs">No. Keahlian Lama</span><span class="font-medium" x-text="selected?.previous_membership_number || '-'"></span></div>
                        <div><span class="text-gray-500 block text-xs">Tahun Keahlian Lama</span><span class="font-medium" x-text="selected?.previous_membership_year || '-'"></span></div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection
