@php $c = $content ?? []; @endphp
<div class="border border-gray-200 rounded-lg p-6 space-y-6 bg-white">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tajuk Halaman</label>
        <input type="text" data-edit-key="title" value="{{ $c['title'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Pengenalan</label>
        <textarea data-edit-key="intro" rows="4" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['intro'] ?? '' }}</textarea>
    </div>
    <h3 class="font-semibold">Sejarah Penubuhan</h3>
    <div>
        <label class="block text-sm text-gray-600 mb-1">Perenggan 1</label>
        <textarea data-edit-key="sejarah_1" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['sejarah_1'] ?? '' }}</textarea>
    </div>
    <div>
        <label class="block text-sm text-gray-600 mb-1">Perenggan 2</label>
        <textarea data-edit-key="sejarah_2" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['sejarah_2'] ?? '' }}</textarea>
    </div>
    <h3 class="font-semibold">Objektif</h3>
    <div>
        <label class="block text-sm text-gray-600 mb-1">Senarai objektif (satu per baris)</label>
        <textarea data-edit-key="objektif" rows="6" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ is_array($c['objektif'] ?? null) ? implode("\n", $c['objektif']) : ($c['objektif'] ?? '') }}</textarea>
        <p class="text-xs text-gray-500 mt-1">Pisahkan setiap objektif dengan baris baru</p>
    </div>
    <h3 class="font-semibold">Struktur Organisasi</h3>
    <div>
        <textarea data-edit-key="struktur" rows="4" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['struktur'] ?? '' }}</textarea>
    </div>
    <h3 class="font-semibold">Keahlian</h3>
    <div>
        <textarea data-edit-key="keahlian" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['keahlian'] ?? '' }}</textarea>
    </div>
    <h3 class="font-semibold">Maklumat Ringkas</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block text-sm text-gray-600 mb-1">Tahun Penubuhan</label>
            <input type="text" data-edit-key="tahun_penubuhan" value="{{ $c['tahun_penubuhan'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">Bilangan Ahli</label>
            <input type="text" data-edit-key="bilangan_ahli" value="{{ $c['bilangan_ahli'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div class="md:col-span-2"><label class="block text-sm text-gray-600 mb-1">Alamat</label>
            <textarea data-edit-key="alamat" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['alamat'] ?? '' }}</textarea></div>
        <div class="md:col-span-2"><label class="block text-sm text-gray-600 mb-1">Hubungi Kami</label>
            <textarea data-edit-key="hubungi" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['hubungi'] ?? '' }}</textarea></div>
    </div>
</div>
