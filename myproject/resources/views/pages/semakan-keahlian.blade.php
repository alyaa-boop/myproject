@extends('layouts.app')

@section('title', 'Semakan Keahlian - Alumni 4B Malaysia')

@section('content')
<div class="container mx-auto px-4 md:px-6 py-8">
    @include('partials.breadcrumb', ['items' => [['label' => 'Semakan Keahlian']]])

    <div class="max-w-3xl mx-auto" x-data="semakanKeahlian">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Semakan Status Keahlian</h1>
            <p class="text-gray-600 mt-2">Semak status keahlian anda dengan menggunakan nombor kad pengenalan atau nombor keahlian.</p>
        </div>

        <div class="rounded-lg border bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Semakan Keahlian</h2>
                <p class="text-sm text-gray-500">Sila pilih kaedah semakan dan masukkan maklumat yang diperlukan.</p>
            </div>
            <div class="p-6">
                <form @submit.prevent="search()" class="space-y-6">
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-3">Kaedah semakan</p>
                        <div class="flex flex-col space-y-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" x-model="searchMethod" value="ic" class="rounded-full border-gray-300 text-primary focus:ring-primary">
                                <span class="text-sm">Nombor Kad Pengenalan (tanpa '-')</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" x-model="searchMethod" value="membership" class="rounded-full border-gray-300 text-primary focus:ring-primary">
                                <span class="text-sm">Nombor Keahlian</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700" x-text="searchMethod === 'ic' ? 'Nombor Kad Pengenalan' : 'Nombor Keahlian'"></label>
                        <div class="flex gap-2">
                            <input type="text" x-model="searchValue" :placeholder="searchMethod === 'ic' ? '123456789012' : 'A123456'" class="flex-1 rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            <button type="submit" :disabled="isSearching || !searchValue.trim()" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 disabled:opacity-50 h-10 px-4">
                                <span x-show="!isSearching" class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    Semak
                                </span>
                                <span x-show="isSearching" class="flex items-center gap-2">
                                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Semak
                                </span>
                            </button>
                        </div>
                    </div>

                    {{-- Found result --}}
                    <template x-if="result && result.status === 'found' && result.data">
                        <div class="mt-6 space-y-4">
                            <div class="rounded-lg border border-green-200 bg-green-50 p-4 flex gap-3">
                                <svg class="h-5 w-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div>
                                    <p class="font-medium text-green-800">Rekod Ditemui</p>
                                    <p class="text-sm text-green-700">Maklumat keahlian anda telah ditemui dalam sistem kami.</p>
                                </div>
                            </div>

                            <div x-data="{ tab: 'info' }">
                                <div class="flex gap-2 border-b mb-4">
                                    <button type="button" @click="tab = 'info'" :class="tab === 'info' ? 'border-b-2 border-primary text-primary font-medium' : 'text-gray-600'" class="px-4 py-2 text-sm">Maklumat Keahlian</button>
                                    <button type="button" @click="tab = 'card'" :class="tab === 'card' ? 'border-b-2 border-primary text-primary font-medium' : 'text-gray-600'" class="px-4 py-2 text-sm">Kad Keahlian Digital</button>
                                </div>
                                <div x-show="tab === 'info'" class="border rounded-lg p-4 space-y-3 text-sm">
                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-medium text-gray-600">Nama</span>
                                        <span x-text="result.data.name"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-medium text-gray-600">No. Kad Pengenalan</span>
                                        <span x-text="result.data.icNumber"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-medium text-gray-600">No. Keahlian</span>
                                        <span x-text="result.data.membershipNumber"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-medium text-gray-600">Negeri</span>
                                        <span x-text="result.data.state"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-medium text-gray-600">Tarikh Pendaftaran</span>
                                        <span x-text="result.data.registrationDate"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-medium text-gray-600">Tarikh Tamat</span>
                                        <span x-text="result.data.expiryDate"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-medium text-gray-600">Status</span>
                                        <span>
                                            <span x-show="result.data.status === 'active'" class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Aktif</span>
                                            <span x-show="result.data.status === 'pending'" class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">Dalam Proses</span>
                                            <span x-show="result.data.status === 'expired'" class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">Tamat Tempoh</span>
                                        </span>
                                    </div>
                                </div>
                                <div x-show="tab === 'card'" x-cloak class="flex flex-col items-center">
                                    <div class="w-full max-w-md aspect-[1.586/1] bg-gradient-to-r from-blue-900 to-blue-800 rounded-xl overflow-hidden shadow-lg p-6 text-white relative mb-4">
                                        <div class="absolute top-4 left-4 flex items-center">
                                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center mr-2">
                                                <span class="text-blue-900 font-bold text-sm">4B</span>
                                            </div>
                                            <div>
                                                <div class="text-xs font-light">ALUMNI</div>
                                                <div class="text-sm font-bold">4B MALAYSIA</div>
                                            </div>
                                        </div>
                                        <div class="absolute top-4 right-4 text-xs">Kad Keahlian Digital</div>
                                        <div class="mt-16 space-y-2">
                                            <div class="text-xl font-bold" x-text="result.data.name"></div>
                                            <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm">
                                                <div>
                                                    <div class="text-blue-200 text-xs">No. Keahlian</div>
                                                    <div x-text="result.data.membershipNumber"></div>
                                                </div>
                                                <div>
                                                    <div class="text-blue-200 text-xs">No. K/P</div>
                                                    <div x-text="result.data.icNumber"></div>
                                                </div>
                                                <div>
                                                    <div class="text-blue-200 text-xs">Negeri</div>
                                                    <div x-text="result.data.state"></div>
                                                </div>
                                                <div>
                                                    <div class="text-blue-200 text-xs">Status</div>
                                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Aktif</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="absolute bottom-4 left-4 text-xs">
                                            <div class="text-blue-200">Tarikh Daftar</div>
                                            <div x-text="result.data.registrationDate"></div>
                                        </div>
                                        <div class="absolute bottom-4 right-4 text-xs">
                                            <div class="text-blue-200">Tarikh Tamat</div>
                                            <div x-text="result.data.expiryDate"></div>
                                        </div>
                                    </div>
                                    <button type="button" @click="alert('Kad digital telah dimuat turun.')" class="inline-flex items-center gap-2 rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 h-10 px-4">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Muat Turun Kad Digital
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Not found --}}
                    <div x-show="result && result.status === 'not-found'" x-cloak class="rounded-lg border border-red-200 bg-red-50 p-4 flex gap-3 mt-6">
                        <svg class="h-5 w-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <p class="font-medium text-red-800">Rekod Tidak Ditemui</p>
                            <p class="text-sm text-red-700">Maklumat yang dimasukkan tidak ditemui dalam sistem kami. Sila semak semula maklumat yang dimasukkan atau daftar sebagai ahli baru.</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="p-6 border-t bg-gray-50 text-sm text-gray-600 space-y-2">
                <p>* Untuk sebarang pertanyaan, sila hubungi kami di 03-1234 5678 atau email ke info@alumni4b.org.my</p>
                <p>Belum menjadi ahli? <a href="{{ route('register') }}" class="text-primary hover:underline">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('semakanKeahlian', () => ({
    searchMethod: 'ic',
    searchValue: '',
    isSearching: false,
    result: null,
    search() {
      if (!this.searchValue.trim()) return;
      this.isSearching = true;
      this.result = null;
      const val = this.searchValue.trim();
      const self = this;
      setTimeout(() => {
        if (val === '123456789012' || val === 'A123456' || val === '03-746352') {
          self.result = {
            status: 'found',
            data: {
              name: val === '03-746352' ? 'Muhammad bin Ibrahim' : 'Ahmad bin Abdullah',
              icNumber: val === '03-746352' ? '880214145678' : '123456789012',
              membershipNumber: val === '03-746352' ? '03-746352' : 'A123456',
              state: val === '03-746352' ? 'Johor' : 'Selangor',
              registrationDate: val === '03-746352' ? '14/02/2023' : '01/01/2022',
              expiryDate: val === '03-746352' ? '14/02/2025' : '01/01/2024',
              status: 'active'
            }
          };
        } else {
          self.result = { status: 'not-found' };
        }
        self.isSearching = false;
      }, 1500);
    }
  }));
});
</script>
@endpush
@endsection
