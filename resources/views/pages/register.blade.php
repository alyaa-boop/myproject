@extends('layouts.app')

@section('title', 'Daftar Keahlian - Alumni 4B Malaysia')

@section('content')
<div class="container mx-auto px-4 md:px-6 py-8" x-data="registerForm">
    @include('partials.breadcrumb', ['items' => [['label' => 'Pendaftaran Keahlian']]])

    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Pendaftaran Keahlian Alumni 4B</h1>
            <p class="text-gray-600 mt-2">Sila isi borang pendaftaran di bawah untuk menjadi ahli Alumni 4B Malaysia.</p>
        </div>

        <div class="rounded-lg border bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Borang Pendaftaran</h2>
                <p class="text-sm text-gray-500">Sila lengkapkan semua maklumat yang diperlukan.</p>
            </div>
            <div class="p-6">
                {{-- Step indicator --}}
                <div class="mb-6">
                    <div class="flex justify-between items-center gap-2 overflow-x-auto pb-2">
                        <div class="flex items-center gap-2">
                            <div :class="step >= 1 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-500'" class="rounded-full w-8 h-8 flex items-center justify-center text-sm font-medium">1</div>
                            <span :class="step >= 1 ? 'font-medium text-gray-900' : 'text-gray-500'" class="text-sm whitespace-nowrap">Maklumat Peribadi</span>
                        </div>
                        <div class="h-0.5 w-8 bg-gray-200 flex-shrink-0"></div>
                        <div class="flex items-center gap-2">
                            <div :class="step >= 2 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-500'" class="rounded-full w-8 h-8 flex items-center justify-center text-sm font-medium">2</div>
                            <span :class="step >= 2 ? 'font-medium text-gray-900' : 'text-gray-500'" class="text-sm whitespace-nowrap">Maklumat Keahlian</span>
                        </div>
                        <div class="h-0.5 w-8 bg-gray-200 flex-shrink-0"></div>
                        <div class="flex items-center gap-2">
                            <div :class="step >= 3 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-500'" class="rounded-full w-8 h-8 flex items-center justify-center text-sm font-medium">3</div>
                            <span :class="step >= 3 ? 'font-medium text-gray-900' : 'text-gray-500'" class="text-sm whitespace-nowrap">Pengesahan</span>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}" @submit="isSubmitting = true">
                    @csrf
                    {{-- Step 1 --}}
                    <div x-show="step === 1" x-cloak class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-medium text-gray-700">Nama Penuh <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" x-model="form.name" value="{{ old('name') }}" placeholder="Nama penuh seperti dalam kad pengenalan" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            <div class="space-y-2">
                                <label for="icNumber" class="text-sm font-medium text-gray-700">No. Kad Pengenalan <span class="text-red-500">*</span></label>
                                <input type="text" id="icNumber" name="ic_number" x-model="form.icNumber" value="{{ old('ic_number') }}" placeholder="Contoh: 123456789012" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="email" class="text-sm font-medium text-gray-700">Alamat E-mel <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" x-model="form.email" value="{{ old('email') }}" placeholder="contoh@email.com" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            <div class="space-y-2">
                                <label for="phone" class="text-sm font-medium text-gray-700">No. Telefon <span class="text-red-500">*</span></label>
                                <input type="text" id="phone" name="phone" x-model="form.phone" value="{{ old('phone') }}" placeholder="Contoh: 0123456789" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="address" class="text-sm font-medium text-gray-700">Alamat <span class="text-red-500">*</span></label>
                            <textarea id="address" name="address" x-model="form.address" rows="3" placeholder="Alamat penuh" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">{{ old('address') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div class="space-y-2">
                                <label for="postcode" class="text-sm font-medium text-gray-700">Poskod <span class="text-red-500">*</span></label>
                                <input type="text" id="postcode" name="postcode" x-model="form.postcode" value="{{ old('postcode') }}" placeholder="Contoh: 50000" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            <div class="space-y-2">
                                <label for="city" class="text-sm font-medium text-gray-700">Bandar <span class="text-red-500">*</span></label>
                                <input type="text" id="city" name="city" x-model="form.city" value="{{ old('city') }}" placeholder="Contoh: Kuala Lumpur" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            <div class="space-y-2">
                                <label for="state" class="text-sm font-medium text-gray-700">Negeri <span class="text-red-500">*</span></label>
                                <select id="state" name="state" x-model="form.state" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                                    <option value="">Pilih negeri</option>
                                    <option value="johor" {{ old('state') == 'johor' ? 'selected' : '' }}>Johor</option><option value="kedah" {{ old('state') == 'kedah' ? 'selected' : '' }}>Kedah</option><option value="kelantan" {{ old('state') == 'kelantan' ? 'selected' : '' }}>Kelantan</option><option value="melaka" {{ old('state') == 'melaka' ? 'selected' : '' }}>Melaka</option><option value="negeri_sembilan" {{ old('state') == 'negeri_sembilan' ? 'selected' : '' }}>Negeri Sembilan</option><option value="pahang" {{ old('state') == 'pahang' ? 'selected' : '' }}>Pahang</option><option value="perak" {{ old('state') == 'perak' ? 'selected' : '' }}>Perak</option><option value="perlis" {{ old('state') == 'perlis' ? 'selected' : '' }}>Perlis</option><option value="pulau_pinang" {{ old('state') == 'pulau_pinang' ? 'selected' : '' }}>Pulau Pinang</option><option value="sabah" {{ old('state') == 'sabah' ? 'selected' : '' }}>Sabah</option><option value="sarawak" {{ old('state') == 'sarawak' ? 'selected' : '' }}>Sarawak</option><option value="selangor" {{ old('state') == 'selangor' ? 'selected' : '' }}>Selangor</option><option value="terengganu" {{ old('state') == 'terengganu' ? 'selected' : '' }}>Terengganu</option><option value="wp_kuala_lumpur" {{ old('state') == 'wp_kuala_lumpur' ? 'selected' : '' }}>WP Kuala Lumpur</option><option value="wp_labuan" {{ old('state') == 'wp_labuan' ? 'selected' : '' }}>WP Labuan</option><option value="wp_putrajaya" {{ old('state') == 'wp_putrajaya' ? 'selected' : '' }}>WP Putrajaya</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="occupation" class="text-sm font-medium text-gray-700">Pekerjaan <span class="text-red-500">*</span></label>
                                <input type="text" id="occupation" name="occupation" x-model="form.occupation" value="{{ old('occupation') }}" placeholder="Contoh: Guru" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            <div class="space-y-2">
                                <label for="employer" class="text-sm font-medium text-gray-700">Majikan <span class="text-red-500">*</span></label>
                                <input type="text" id="employer" name="employer" x-model="form.employer" value="{{ old('employer') }}" placeholder="Contoh: Kementerian Pendidikan Malaysia" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>
                    </div>

                    {{-- Step 2 --}}
                    <div x-show="step === 2" x-cloak class="space-y-4">
                        <div class="bg-gray-100 p-4 rounded-lg mb-4">
                            <h3 class="font-medium text-gray-900 mb-2">Maklumat Keahlian 4B</h3>
                            <p class="text-sm text-gray-600">Sila isi maklumat keahlian 4B anda sebelum ini. Jika anda tidak pernah menjadi ahli 4B, sila tinggalkan kosong.</p>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="previousMembershipNumber" class="text-sm font-medium text-gray-700">No. Keahlian 4B (jika ada)</label>
                                <input type="text" id="previousMembershipNumber" name="previous_membership_number" x-model="form.previousMembershipNumber" value="{{ old('previous_membership_number') }}" placeholder="Contoh: B123456" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                            <div class="space-y-2">
                                <label for="previousMembershipYear" class="text-sm font-medium text-gray-700">Tahun Keahlian</label>
                                <input type="text" id="previousMembershipYear" name="previous_membership_year" x-model="form.previousMembershipYear" value="{{ old('previous_membership_year') }}" placeholder="Contoh: 2010-2015" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Dokumen Sokongan</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <svg class="h-8 w-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                <p class="text-sm font-medium text-gray-600">Seret dan lepas fail di sini atau klik untuk memuat naik</p>
                                <p class="text-xs text-gray-500 mt-1">Sila muat naik salinan kad pengenalan dan bukti keahlian 4B (jika ada)</p>
                                <button type="button" class="mt-2 inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-300 bg-white hover:bg-gray-50 h-9 px-4">Pilih Fail</button>
                            </div>
                        </div>
                    </div>

                    {{-- Step 3 --}}
                    <div x-show="step === 3" x-cloak class="space-y-4">
                        <div class="bg-gray-100 p-4 rounded-lg mb-4">
                            <h3 class="font-medium text-gray-900 mb-2">Pengesahan Maklumat</h3>
                            <p class="text-sm text-gray-600">Sila semak semua maklumat yang telah diisi sebelum menghantar borang pendaftaran.</p>
                        </div>
                        <div class="border rounded-lg p-4 space-y-4 text-sm">
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Maklumat Peribadi</h4>
                                <div class="grid grid-cols-2 gap-2">
                                    <span class="text-gray-500">Nama Penuh:</span><span x-text="form.name || '-'"></span>
                                    <span class="text-gray-500">No. Kad Pengenalan:</span><span x-text="form.icNumber || '-'"></span>
                                    <span class="text-gray-500">Alamat E-mel:</span><span x-text="form.email || '-'"></span>
                                    <span class="text-gray-500">No. Telefon:</span><span x-text="form.phone || '-'"></span>
                                    <span class="text-gray-500">Alamat:</span><span x-text="form.address || '-'"></span>
                                    <span class="text-gray-500">Poskod:</span><span x-text="form.postcode || '-'"></span>
                                    <span class="text-gray-500">Bandar:</span><span x-text="form.city || '-'"></span>
                                    <span class="text-gray-500">Negeri:</span><span x-text="form.state || '-'"></span>
                                    <span class="text-gray-500">Pekerjaan:</span><span x-text="form.occupation || '-'"></span>
                                    <span class="text-gray-500">Majikan:</span><span x-text="form.employer || '-'"></span>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Maklumat Keahlian 4B</h4>
                                <div class="grid grid-cols-2 gap-2">
                                    <span class="text-gray-500">No. Keahlian 4B:</span><span x-text="form.previousMembershipNumber || '-'"></span>
                                    <span class="text-gray-500">Tahun Keahlian:</span><span x-text="form.previousMembershipYear || '-'"></span>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Pilihan Kad Keahlian</h4>
                                <div class="grid grid-cols-2 gap-2">
                                    <span class="text-gray-500">Kad Digital:</span><span>Ya</span>
                                    <span class="text-gray-500">Kad Fizikal:</span><span x-text="form.physicalCard ? 'Ya' : 'Tidak'"></span>
                                </div>
                            </div>
                        </div>
                        <label class="flex items-start gap-2 cursor-pointer pt-4">
                            <input type="checkbox" name="physical_card" value="1" x-model="form.physicalCard" {{ old('physical_card') ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary mt-1">
                            <div>
                                <span class="text-sm font-medium text-gray-900">Saya ingin mendapatkan kad keahlian fizikal</span>
                                <p class="text-sm text-gray-500">Kad keahlian digital akan disediakan secara automatik. Kad fizikal akan dikenakan caj tambahan RM10.</p>
                            </div>
                        </label>
                        <label class="flex items-start gap-2 cursor-pointer pt-4">
                            <input type="checkbox" name="agree_terms" value="1" x-model="form.agreeTerms" class="rounded border-gray-300 text-primary focus:ring-primary mt-1">
                            <div>
                                <span class="text-sm font-medium text-gray-900">Saya mengesahkan bahawa semua maklumat yang diberikan adalah benar dan tepat</span>
                                <p class="text-sm text-gray-500">Saya bersetuju dengan terma dan syarat keahlian Alumni 4B Malaysia</p>
                            </div>
                        </label>
                    </div>

                    <div class="flex justify-between mt-8">
                        <template x-if="step > 1">
                            <button type="button" @click="step--" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-300 bg-white hover:bg-gray-50 h-10 px-4">Kembali</button>
                        </template>
                        <template x-if="step === 1">
                            <div></div>
                        </template>
                        <template x-if="step < 3">
                            <button type="button" @click="step++" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 h-10 px-6">Seterusnya</button>
                        </template>
                        <template x-if="step === 3">
                            <button type="submit" :disabled="isSubmitting" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 disabled:opacity-50 h-10 px-6">
                                <span x-show="!isSubmitting">Hantar Pendaftaran</span>
                                <span x-show="isSubmitting" class="flex items-center gap-2" x-cloak>
                                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Menghantar...
                                </span>
                            </button>
                        </template>
                    </div>
                </form>
            </div>
            <div class="p-6 border-t bg-gray-50 text-sm text-gray-600 space-y-2">
                <p>* Untuk sebarang pertanyaan, sila hubungi kami di 03-1234 5678 atau email ke info@alumni4b.org.my</p>
                <p>Sudah menjadi ahli? <a href="{{ route('login') }}" class="text-primary hover:underline">Log masuk</a></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('registerForm', () => ({
    step: 1,
    isSubmitting: false,
    form: {
      name: @json(old('name', '')),
      icNumber: @json(old('ic_number', '')),
      email: @json(old('email', '')),
      phone: @json(old('phone', '')),
      address: @json(old('address', '')),
      postcode: @json(old('postcode', '')),
      city: @json(old('city', '')),
      state: @json(old('state', '')),
      occupation: @json(old('occupation', '')),
      employer: @json(old('employer', '')),
      previousMembershipNumber: @json(old('previous_membership_number', '')),
      previousMembershipYear: @json(old('previous_membership_year', '')),
      physicalCard: @json((bool) old('physical_card', false)),
      agreeTerms: @json((bool) old('agree_terms', false))
    },
  }));
});
</script>
@endpush
@endsection
