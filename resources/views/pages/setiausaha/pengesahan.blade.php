@extends('layouts.app')

@section('title', 'Pengesahan Keahlian')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-6 mb-10 space-y-6" x-data="{ tab: 'menunggu', q: '', modalOpen: false, selected: null }">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold">Pengesahan Keahlian</h1>
        <p class="text-sm text-gray-600">
            Senarai permohonan keahlian yang menunggu pengesahan untuk negeri {{ $stateLabel ?? 'Alumni 4B' }}.
        </p>
    </div>

    @if(session('success'))
    <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">{{ session('error') }}</div>
    @endif

    {{-- Search --}}
    <div class="space-y-2">
        <label class="text-sm font-medium text-gray-700">Carian</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" x-model="q" placeholder="Cari mengikut nama atau ID..."
                class="w-full rounded-md border border-[#BAC4F7] px-10 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
            />
        </div>
    </div>

    {{-- Tabs --}}
    <div class="inline-flex bg-[#EEF1FF] rounded-md p-1 gap-1">
        <button @click="tab='menunggu'" :class="tab==='menunggu' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
            class="px-3 py-2 text-sm font-medium rounded-md transition">
            Menunggu Pengesahan <span class="ml-1 text-xs text-gray-500">{{ $menunggu->count() }}</span>
        </button>
        <button @click="tab='menunggu_hq'" :class="tab==='menunggu_hq' ? 'bg-white text-black shadow-sm' : 'text-gray-600'"
            class="px-3 py-2 text-sm font-medium rounded-md transition">
            Dihantar ke HQ <span class="ml-1 text-xs text-gray-500">{{ $menungguHq->count() }}</span>
        </button>
    </div>

    {{-- Card + Table --}}
    <div class="border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">
        <div class="p-6 border-b border-[#BAC4F7]">
            <h2 class="font-semibold" x-text="tab === 'menunggu' ? 'Permohonan Menunggu Pengesahan' : 'Dihantar ke HQ'"></h2>
            <p class="text-sm text-gray-500 mt-1" x-text="tab === 'menunggu' ? 'Senarai permohonan keahlian yang menunggu pengesahan anda.' : 'Senarai permohonan yang telah disahkan dan menunggu kelulusan HQ.'"></p>
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
                    @forelse($menunggu as $k)
                    @php
                        $kd = ['id'=>$k->id,'name'=>$k->name,'ic_number'=>$k->ic_number,'email'=>$k->email,'phone'=>$k->phone,'address'=>$k->address,'postcode'=>$k->postcode,'city'=>$k->city,'nama_negeri'=>$k->nama_negeri,'occupation'=>$k->occupation,'employer'=>$k->employer,'previous_membership_number'=>$k->previous_membership_number,'previous_membership_year'=>$k->previous_membership_year,'physical_card'=>$k->physical_card,'created_at'=>$k->created_at->format('d/m/Y')];
                    @endphp
                    <tr class="border-b border-[#BAC4F7]/60" data-keahlian="{{ base64_encode(json_encode($kd)) }}">
                        <td class="p-3">P{{ str_pad($k->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="p-3">{{ $k->name }} ({{ $k->nama_negeri }})</td>
                        <td class="p-3">{{ $k->created_at->format('d/m/Y') }}</td>
                        <td class="p-3"><span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">Menunggu Pengesahan</span></td>
                        <td class="p-3">
                            <div class="flex items-center gap-2 flex-wrap">
                                <button type="button" @click="selected=JSON.parse(atob($el.closest('tr').getAttribute('data-keahlian'))); modalOpen=true"
                                    class="px-3 py-1 text-xs border border-gray-500 text-gray-700 bg-gray-50 rounded-md hover:bg-gray-100">Lihat</button>
                                <form action="{{ route('keahlian.sahkan', $k->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 text-xs border border-green-600 text-green-700 bg-green-50 rounded-md hover:bg-green-100">Sahkan</button>
                                </form>
                                <form action="{{ route('keahlian.tolak', $k->id) }}" method="POST" class="inline" onsubmit="return confirm('Adakah anda pasti untuk menolak permohonan ini?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 text-xs border border-red-500 text-red-600 bg-red-50 rounded-md hover:bg-red-100">Tolak</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-6 text-center text-sm text-gray-500">Tiada rekod ditemui.</td></tr>
                    @endforelse
                </tbody>

                {{-- DIHANTAR KE HQ --}}
                <tbody x-show="tab==='menunggu_hq'" x-cloak>
                    @forelse($menungguHq as $k)
                    @php
                        $kd = ['id'=>$k->id,'name'=>$k->name,'ic_number'=>$k->ic_number,'email'=>$k->email,'phone'=>$k->phone,'address'=>$k->address,'postcode'=>$k->postcode,'city'=>$k->city,'nama_negeri'=>$k->nama_negeri,'occupation'=>$k->occupation,'employer'=>$k->employer,'previous_membership_number'=>$k->previous_membership_number,'previous_membership_year'=>$k->previous_membership_year,'physical_card'=>$k->physical_card,'created_at'=>$k->created_at->format('d/m/Y')];
                    @endphp
                    <tr class="border-b border-[#BAC4F7]/60" data-keahlian="{{ base64_encode(json_encode($kd)) }}">
                        <td class="p-3">P{{ str_pad($k->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="p-3">{{ $k->name }} ({{ $k->nama_negeri }})</td>
                        <td class="p-3">{{ $k->updated_at->format('d/m/Y') }}</td>
                        <td class="p-3"><span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">Menunggu HQ</span></td>
                        <td class="p-3">
                            <button type="button" @click="selected=JSON.parse(atob($el.closest('tr').getAttribute('data-keahlian'))); modalOpen=true"
                                class="px-3 py-1 text-xs border border-gray-500 text-gray-700 bg-gray-50 rounded-md hover:bg-gray-100">Lihat</button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-6 text-center text-sm text-gray-500">Tiada rekod ditemui.</td></tr>
                    @endforelse
                </tbody>
            </table>
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
