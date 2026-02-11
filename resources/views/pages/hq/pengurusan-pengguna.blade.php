@extends('layouts.app')

@section('title', 'Pengurusan Pengguna - HQ')

@section('content')
<div class="max-w-6xl mx-auto px-4 mt-6 mb-10 space-y-6" x-data="{ modalTambah: {{ $errors->any() ? 'true' : 'false' }} }">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Pengurusan Pengguna</h1>
            <p class="text-sm text-gray-600">Senarai akaun HQ dan Setiausaha negeri. HQ boleh menambah pengguna baharu atau nyahaktif akaun.</p>
        </div>
        <button type="button" @click="modalTambah = true"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-primary/90">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pengguna
        </button>
    </div>

    @if(session('success'))
    <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">{{ session('error') }}</div>
    @endif

    <div class="border border-[#BAC4F7] rounded-lg bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-left border-b border-[#BAC4F7] bg-gray-50">
                    <tr>
                        <th class="p-3 font-medium">Nama</th>
                        <th class="p-3 font-medium">E-mel</th>
                        <th class="p-3 font-medium w-32">Peranan</th>
                        <th class="p-3 font-medium w-36">Negeri</th>
                        <th class="p-3 font-medium w-28">Status</th>
                        <th class="p-3 font-medium w-32">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                    <tr class="border-b border-[#BAC4F7]/60">
                        <td class="p-3 font-medium">{{ $u->name }}</td>
                        <td class="p-3">{{ $u->email }}</td>
                        <td class="p-3">
                            @if($u->role === 'hq')
                                <span class="inline-flex items-center rounded-full bg-indigo-100 text-indigo-700 px-2.5 py-0.5 text-xs font-medium">HQ</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-amber-100 text-amber-700 px-2.5 py-0.5 text-xs font-medium">Setiausaha</span>
                            @endif
                        </td>
                        <td class="p-3">{{ $u->state ? \App\Models\Keahlian::namaNegeri($u->state) : '-' }}</td>
                        <td class="p-3">
                            @if($u->approved)
                                <span class="inline-flex items-center rounded-full bg-green-100 text-green-700 px-2.5 py-0.5 text-xs font-medium">Aktif</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-600 px-2.5 py-0.5 text-xs font-medium">Belum Diluluskan</span>
                            @endif
                        </td>
                        <td class="p-3">
                            @if($u->id !== session('user.id'))
                            <form action="{{ route('hq.pengurusan-pengguna.deactivate', $u->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Adakah anda pasti untuk nyahaktif akaun {{ $u->name }}? Pengguna tidak akan dapat log masuk lagi.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 text-xs font-medium">Nyahaktif</button>
                            </form>
                            @else
                            <span class="text-gray-400 text-xs">(Akaun anda)</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="p-8 text-center text-gray-500">Tiada pengguna berdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah Pengguna --}}
    <div x-show="modalTambah" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4"
         @keydown.escape.window="modalTambah=false" @click.self="modalTambah=false">
        <div class="w-full max-w-md max-h-[90vh] overflow-y-auto rounded-lg bg-white border border-[#BAC4F7] shadow-xl">
            <div class="p-4 border-b border-[#BAC4F7] flex items-center justify-between">
                <h3 class="font-semibold text-lg">Tambah Pengguna Baharu</h3>
                <button type="button" class="p-2 hover:bg-gray-100 rounded" @click="modalTambah=false" aria-label="Tutup">✕</button>
            </div>
            <form method="POST" action="{{ route('hq.pengurusan-pengguna.store') }}" class="p-6 space-y-4" x-data="{ role: '{{ old('role', '') }}' }">
                @csrf
                <div class="space-y-2">
                    <label for="add_name" class="text-sm font-medium text-gray-700">Nama Penuh</label>
                    <input type="text" name="name" id="add_name" value="{{ old('name') }}" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                        placeholder="Nama penuh">
                    @error('name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2">
                    <label for="add_email" class="text-sm font-medium text-gray-700">Alamat E-mel</label>
                    <input type="email" name="email" id="add_email" value="{{ old('email') }}" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                        placeholder="contoh@email.com">
                    @error('email')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2">
                    <label for="add_password" class="text-sm font-medium text-gray-700">Kata Laluan</label>
                    <input type="password" name="password" id="add_password" required minlength="8"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                        placeholder="Minimum 8 aksara">
                    @error('password')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2">
                    <label for="add_password_confirmation" class="text-sm font-medium text-gray-700">Sahkan Kata Laluan</label>
                    <input type="password" name="password_confirmation" id="add_password_confirmation" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                        placeholder="Ulang kata laluan">
                </div>
                <div class="space-y-2">
                    <label for="add_role" class="text-sm font-medium text-gray-700">Peranan</label>
                    <select name="role" id="add_role" required x-model="role"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                        <option value="">Pilih peranan</option>
                        <option value="hq" {{ old('role') == 'hq' ? 'selected' : '' }}>HQ</option>
                        <option value="setiausaha" {{ old('role') == 'setiausaha' ? 'selected' : '' }}>Setiausaha Negeri</option>
                    </select>
                    @error('role')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2" x-show="role === 'setiausaha'" x-cloak>
                    <label for="add_state" class="text-sm font-medium text-gray-700">Negeri</label>
                    <select name="state" id="add_state"
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
                    @error('state')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-primary/90">Simpan</button>
                    <button type="button" @click="modalTambah=false" class="px-4 py-2 text-sm font-medium border border-gray-300 rounded-md hover:bg-gray-50">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
