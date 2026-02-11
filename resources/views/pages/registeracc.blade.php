@extends('layouts.app')

@section('title', 'Daftar Akaun Staf - Alumni 4B Malaysia')

@section('content')
<div class="container mx-auto px-4 md:px-6 py-8">
    @include('partials.breadcrumb', ['items' => [['label' => 'Daftar Akaun Staf']]])

    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Akaun Staf</h1>
            <p class="text-gray-600 mt-2">Untuk Setiausaha negeri atau HQ. Sila lengkapkan maklumat di bawah.</p>
        </div>

        <div class="rounded-lg border bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Borang Pendaftaran Akaun</h2>
                <p class="text-sm text-gray-500">Akaun anda perlu diluluskan oleh pentadbir sebelum boleh log masuk.</p>
            </div>
            <div class="p-6">
                @if(session('error'))
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 mb-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 p-4 mb-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 mb-4 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('registeracc.post') }}" class="space-y-4" x-data="{ isLoading: false, role: '{{ old('role', '') }}' }" @submit="isLoading = true">
                    @csrf
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-medium text-gray-700">Nama Penuh</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                            placeholder="Nama penuh">
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-gray-700">Alamat E-mel</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                            placeholder="contoh@email.com">
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium text-gray-700">Kata Laluan</label>
                        <input type="password" name="password" id="password" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                            placeholder="Minimum 8 aksara">
                    </div>
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-sm font-medium text-gray-700">Sahkan Kata Laluan</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                            placeholder="Ulang kata laluan">
                    </div>
                    <div class="space-y-2">
                        <label for="role" class="text-sm font-medium text-gray-700">Peranan</label>
                        <select name="role" id="role" required x-model="role"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="">Pilih peranan</option>
                            <option value="hq" {{ old('role') == 'hq' ? 'selected' : '' }}>HQ</option>
                            <option value="setiausaha" {{ old('role') == 'setiausaha' ? 'selected' : '' }}>Setiausaha Negeri</option>
                        </select>
                    </div>
                    <div class="space-y-2" x-show="role === 'setiausaha'" x-cloak>
                        <label for="state" class="text-sm font-medium text-gray-700">Negeri</label>
                        <select name="state" id="state"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                            :required="role === 'setiausaha'">
                            <option value="">Pilih negeri</option>
                            <option value="johor" {{ old('state') == 'johor' ? 'selected' : '' }}>Johor</option>
                            <option value="kedah" {{ old('state') == 'kedah' ? 'selected' : '' }}>Kedah</option>
                            <option value="kelantan" {{ old('state') == 'kelantan' ? 'selected' : '' }}>Kelantan</option>
                            <option value="melaka" {{ old('state') == 'melaka' ? 'selected' : '' }}>Melaka</option>
                            <option value="negeri_sembilan" {{ old('state') == 'negeri_sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                            <option value="pahang" {{ old('state') == 'pahang' ? 'selected' : '' }}>Pahang</option>
                            <option value="perak" {{ old('state') == 'perak' ? 'selected' : '' }}>Perak</option>
                            <option value="perlis" {{ old('state') == 'perlis' ? 'selected' : '' }}>Perlis</option>
                            <option value="pulau_pinang" {{ old('state') == 'pulau_pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                            <option value="sabah" {{ old('state') == 'sabah' ? 'selected' : '' }}>Sabah</option>
                            <option value="sarawak" {{ old('state') == 'sarawak' ? 'selected' : '' }}>Sarawak</option>
                            <option value="selangor" {{ old('state') == 'selangor' ? 'selected' : '' }}>Selangor</option>
                            <option value="terengganu" {{ old('state') == 'terengganu' ? 'selected' : '' }}>Terengganu</option>
                            <option value="wp_kuala_lumpur" {{ old('state') == 'wp_kuala_lumpur' ? 'selected' : '' }}>WP Kuala Lumpur</option>
                            <option value="wp_labuan" {{ old('state') == 'wp_labuan' ? 'selected' : '' }}>WP Labuan</option>
                            <option value="wp_putrajaya" {{ old('state') == 'wp_putrajaya' ? 'selected' : '' }}>WP Putrajaya</option>
                        </select>
                        <p class="text-xs text-gray-500" x-show="role === 'setiausaha'">Anda hanya akan nampak ahli dari negeri ini sahaja.</p>
                    </div>
                    <button type="submit" :disabled="isLoading" class="w-full inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 disabled:opacity-50 h-10">
                        <span x-show="!isLoading">Daftar Akaun</span>
                        <span x-show="isLoading" class="flex items-center gap-2">
                            <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Mendaftar...
                        </span>
                    </button>
                </form>
            </div>
            <div class="p-6 border-t bg-gray-50 text-center text-sm text-gray-600">
                Sudah mempunyai akaun? <a href="{{ route('login') }}" class="text-primary hover:underline">Log masuk</a>
            </div>
        </div>
    </div>
</div>
@endsection
