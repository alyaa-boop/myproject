@php $c = $content ?? []; @endphp
{{-- Edit view sama layout seperti laman Latar Belakang --}}
<div class="container mx-auto px-4 md:px-6 py-8 rounded-lg border border-gray-200 bg-white">
    <div class="grid gap-8 md:grid-cols-3">
        <div class="md:col-span-2 space-y-6">
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Tajuk Halaman</label>
                <input type="text" data-edit-key="title" value="{{ $c['title'] ?? 'Latar Belakang Alumni 4B Malaysia' }}"
                    class="w-full text-3xl font-bold text-gray-900 rounded-md border border-gray-200 px-3 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
            </div>

            <div class="aspect-video bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-sm">Sejarah 4B</div>

            <div class="prose prose-gray max-w-none space-y-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Pengenalan</label>
                    <textarea data-edit-key="intro" rows="3" class="w-full text-gray-600 rounded-md border border-gray-200 px-3 py-2 focus:border-primary focus:ring-1">{{ $c['intro'] ?? 'Alumni 4B Malaysia merupakan sebuah pertubuhan yang ditubuhkan untuk menghimpunkan bekas ahli Pertubuhan Belia 4B Malaysia.' }}</textarea>
                </div>

                <div>
                    <input type="text" data-edit-key="sejarah_title" value="{{ $c['sejarah_title'] ?? 'Sejarah Penubuhan' }}"
                        class="text-xl font-bold text-gray-900 border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-1 w-full">
                    <textarea data-edit-key="sejarah_1" rows="3" class="w-full text-gray-600 mt-2 rounded-md border border-gray-200 px-3 py-2 text-sm focus:border-primary">{{ $c['sejarah_1'] ?? '' }}</textarea>
                    <textarea data-edit-key="sejarah_2" rows="3" class="w-full text-gray-600 mt-2 rounded-md border border-gray-200 px-3 py-2 text-sm focus:border-primary">{{ $c['sejarah_2'] ?? '' }}</textarea>
                </div>

                <div>
                    <input type="text" data-edit-key="objektif_title" value="{{ $c['objektif_title'] ?? 'Objektif' }}"
                        class="text-xl font-bold text-gray-900 border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-1 w-full">
                    <label class="block text-xs text-gray-500 mt-2 mb-1">Senarai objektif (satu per baris)</label>
                    <textarea data-edit-key="objektif" rows="6" class="w-full text-gray-600 rounded-md border border-gray-200 px-3 py-2 text-sm focus:border-primary">{{ is_array($c['objektif'] ?? null) ? implode("\n", $c['objektif']) : ($c['objektif'] ?? '') }}</textarea>
                </div>

                <div>
                    <input type="text" data-edit-key="struktur_title" value="{{ $c['struktur_title'] ?? 'Struktur Organisasi' }}"
                        class="text-xl font-bold text-gray-900 border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-1 w-full">
                    <textarea data-edit-key="struktur" rows="4" class="w-full text-gray-600 mt-2 rounded-md border border-gray-200 px-3 py-2 text-sm focus:border-primary">{{ $c['struktur'] ?? '' }}</textarea>
                </div>

                <div>
                    <input type="text" data-edit-key="keahlian_title" value="{{ $c['keahlian_title'] ?? 'Keahlian' }}"
                        class="text-xl font-bold text-gray-900 border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-1 w-full">
                    <textarea data-edit-key="keahlian" rows="3" class="w-full text-gray-600 mt-2 rounded-md border border-gray-200 px-3 py-2 text-sm focus:border-primary">{{ $c['keahlian'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-lg border bg-white shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Maklumat Ringkas</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="font-medium text-gray-700">Tahun Penubuhan</p>
                        <input type="text" data-edit-key="tahun_penubuhan" value="{{ $c['tahun_penubuhan'] ?? '2010' }}"
                            class="mt-1 w-full text-gray-600 rounded border border-gray-200 px-2 py-1 text-sm focus:border-primary">
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Bilangan Ahli</p>
                        <input type="text" data-edit-key="bilangan_ahli" value="{{ $c['bilangan_ahli'] ?? '10,000+ di seluruh Malaysia' }}"
                            class="mt-1 w-full text-gray-600 rounded border border-gray-200 px-2 py-1 text-sm focus:border-primary">
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Alamat Ibu Pejabat</p>
                        <textarea data-edit-key="alamat" rows="3" class="mt-1 w-full text-gray-600 rounded border border-gray-200 px-2 py-1 text-sm focus:border-primary">{{ $c['alamat'] ?? "Ibu Pejabat Alumni 4B Malaysia\nJalan Contoh, 50000 Kuala Lumpur" }}</textarea>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Hubungi Kami</p>
                        <textarea data-edit-key="hubungi" rows="2" class="mt-1 w-full text-gray-600 rounded border border-gray-200 px-2 py-1 text-sm focus:border-primary">{{ $c['hubungi'] ?? "Tel: 03-1234 5678\nEmail: info@alumni4b.org.my" }}</textarea>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border bg-white shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Dokumen Berkaitan</h3>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li>Perlembagaan Alumni 4B Malaysia</li>
                    <li>Laporan Tahunan 2024</li>
                </ul>
            </div>
        </div>
    </div>
</div>
