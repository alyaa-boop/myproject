@php $c = $content ?? []; @endphp
{{-- Edit view mengikut layout sebenar laman utama - sama view supaya tak pening --}}
<div class="flex flex-col bg-white rounded-lg overflow-hidden border border-gray-200">
    {{-- Hero Section (sama seperti laman utama) --}}
    <section class="w-full py-12 md:py-24 lg:py-32 bg-primary text-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid gap-6 lg:grid-cols-2 lg:gap-12 items-center">
                <div class="space-y-4">
                    <label class="block text-xs font-medium text-white/70 mb-1">Tajuk Hero</label>
                    <input type="text" data-edit-key="hero_title" value="{{ $c['hero_title'] ?? 'Selamat Datang ke Portal Alumni 4B Malaysia' }}"
                        class="w-full text-3xl font-bold tracking-tight sm:text-4xl md:text-5xl bg-white/10 border border-white/30 rounded-md px-3 py-2 text-white placeholder-white/60 focus:ring-2 focus:ring-white/50">
                    <label class="block text-xs font-medium text-white/70 mb-1">Sari Kata</label>
                    <textarea data-edit-key="hero_subtitle" rows="3"
                        class="w-full md:text-xl text-white/90 bg-white/10 border border-white/30 rounded-md px-3 py-2 text-white placeholder-white/60 focus:ring-2 focus:ring-white/50">{{ $c['hero_subtitle'] ?? 'Menghubungkan semua bekas ahli 4B di seluruh Malaysia untuk terus menyumbang kepada pembangunan masyarakat dan negara.' }}</textarea>
                    <div class="flex flex-col gap-2 min-[400px]:flex-row pt-2">
                        <span class="inline-flex items-center rounded-md text-sm font-medium bg-white text-primary h-11 px-8">Daftar Keahlian</span>
                        <span class="inline-flex items-center rounded-md text-sm font-medium border-2 border-white text-white h-11 px-8">Semak Keahlian</span>
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Alumni%20Logo-HUJe1PdYiSPMjJRbCOIcxHYXnPhDBV.png" alt="Alumni 4B Logo" class="w-64 h-64 md:w-72 md:h-72 rounded-full bg-white p-4 object-contain">
                </div>
            </div>
        </div>
    </section>

    {{-- Perkhidmatan Kami (sama layout seperti laman utama) --}}
    <section class="w-full py-12 md:py-24 lg:py-32 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col items-center justify-center space-y-4 text-center mb-12">
                <div class="space-y-2 w-full max-w-[900px]">
                    <label class="block text-xs font-medium text-gray-500 mb-1">Tajuk Seksyen</label>
                    <input type="text" data-edit-key="services_title" value="{{ $c['services_title'] ?? 'Perkhidmatan Kami' }}"
                        class="w-full text-center text-3xl font-bold tracking-tight sm:text-5xl text-gray-900 rounded-md border border-gray-200 px-3 py-2">
                    <label class="block text-xs font-medium text-gray-500 mb-1">Keterangan</label>
                    <textarea data-edit-key="services_subtitle" rows="2" class="w-full text-center max-w-[900px] text-gray-600 md:text-xl rounded-md border border-gray-200 px-3 py-2">{{ $c['services_subtitle'] ?? 'Portal Alumni 4B menyediakan pelbagai perkhidmatan untuk memudahkan bekas ahli 4B untuk terus berhubung dan menyumbang.' }}</textarea>
                </div>
            </div>
            <div class="mx-auto grid max-w-5xl items-stretch gap-6 md:grid-cols-2 lg:grid-cols-3">
                {{-- Kad Keahlian --}}
                <div class="rounded-lg border bg-white shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 flex flex-row items-center gap-4 border-b">
                        <svg class="h-8 w-8 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <div class="flex-1 space-y-1">
                            <input type="text" data-edit-key="keahlian_title" value="{{ $c['keahlian_title'] ?? 'Keahlian' }}" class="block w-full text-lg font-semibold border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-0">
                            <input type="text" data-edit-key="keahlian_subtitle" value="{{ $c['keahlian_subtitle'] ?? 'Daftar dan semak status keahlian anda' }}" class="block w-full text-sm text-gray-500 border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-0">
                        </div>
                    </div>
                    <div class="p-6 flex-1">
                        <textarea data-edit-key="keahlian_desc" rows="3" class="w-full text-sm text-gray-600 border border-gray-100 rounded px-2 py-1 focus:border-primary focus:ring-1">{{ $c['keahlian_desc'] ?? 'Sistem pengurusan keahlian yang komprehensif untuk memudahkan pendaftaran dan pengesahan keahlian alumni.' }}</textarea>
                    </div>
                    <div class="p-6 pt-0">
                        <span class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-200 bg-white h-9 px-4 w-full text-gray-500">Ketahui Lebih Lanjut</span>
                    </div>
                </div>
                {{-- Kad Aktiviti --}}
                <div class="rounded-lg border bg-white shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 flex flex-row items-center gap-4 border-b">
                        <svg class="h-8 w-8 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z"/></svg>
                        <div class="flex-1 space-y-1">
                            <input type="text" data-edit-key="aktiviti_title" value="{{ $c['aktiviti_title'] ?? 'Aktiviti' }}" class="block w-full text-lg font-semibold border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-0">
                            <input type="text" data-edit-key="aktiviti_subtitle" value="{{ $c['aktiviti_subtitle'] ?? 'Program dan aktiviti terkini' }}" class="block w-full text-sm text-gray-500 border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-0">
                        </div>
                    </div>
                    <div class="p-6 flex-1">
                        <textarea data-edit-key="aktiviti_desc" rows="3" class="w-full text-sm text-gray-600 border border-gray-100 rounded px-2 py-1 focus:border-primary focus:ring-1">{{ $c['aktiviti_desc'] ?? 'Maklumat mengenai program dan aktiviti yang dianjurkan oleh Alumni 4B di peringkat kebangsaan dan negeri.' }}</textarea>
                    </div>
                    <div class="p-6 pt-0">
                        <span class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-200 bg-white h-9 px-4 text-gray-500">Lihat Aktiviti</span>
                    </div>
                </div>
                {{-- Kad Galeri --}}
                <div class="rounded-lg border bg-white shadow-sm overflow-hidden flex flex-col md:col-span-2 lg:col-span-1">
                    <div class="p-6 flex flex-row items-center gap-4 border-b">
                        <svg class="h-8 w-8 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <div class="flex-1 space-y-1">
                            <input type="text" data-edit-key="galeri_title" value="{{ $c['galeri_title'] ?? 'Galeri' }}" class="block w-full text-lg font-semibold border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-0">
                            <input type="text" data-edit-key="galeri_subtitle" value="{{ $c['galeri_subtitle'] ?? 'Koleksi gambar aktiviti' }}" class="block w-full text-sm text-gray-500 border-0 border-b border-transparent hover:border-gray-200 focus:border-primary rounded-none px-0 py-0">
                        </div>
                    </div>
                    <div class="p-6 flex-1">
                        <textarea data-edit-key="galeri_desc" rows="3" class="w-full text-sm text-gray-600 border border-gray-100 rounded px-2 py-1 focus:border-primary focus:ring-1">{{ $c['galeri_desc'] ?? 'Galeri gambar aktiviti dan program yang telah dijalankan oleh Alumni 4B di seluruh Malaysia.' }}</textarea>
                    </div>
                    <div class="p-6 pt-0">
                        <span class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-200 bg-white h-9 px-4 text-gray-500">Lihat Galeri</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Aktiviti Terkini (sama layout seperti laman utama) --}}
    <section class="w-full py-12 md:py-24 lg:py-32 bg-gray-100">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col items-center justify-center space-y-4 text-center mb-12">
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-gray-500 mb-1">Tajuk Seksyen</label>
                    <input type="text" data-edit-key="latest_title" value="{{ $c['latest_title'] ?? 'Aktiviti Terkini' }}" class="text-center text-3xl font-bold tracking-tight sm:text-5xl text-gray-900 rounded-md border border-gray-200 px-3 py-2">
                    <label class="block text-xs font-medium text-gray-500 mb-1">Keterangan</label>
                    <textarea data-edit-key="latest_subtitle" rows="2" class="max-w-[900px] mx-auto text-center text-gray-600 md:text-xl rounded-md border border-gray-200 px-3 py-2 w-full">{{ $c['latest_subtitle'] ?? 'Sertai aktiviti-aktiviti terkini yang dianjurkan oleh Alumni 4B di seluruh Malaysia.' }}</textarea>
                </div>
            </div>
            @php $activities = array_slice(($c['activities'] ?? []), 0, 4); while (count($activities) < 4) { $activities[] = ['title' => '', 'date' => '', 'location' => '', 'desc' => '']; } @endphp
            <div data-edit-array="activities" class="mx-auto grid max-w-5xl gap-8 md:grid-cols-2">
                @foreach($activities as $i => $a)
                <div data-edit-item class="rounded-lg border bg-white shadow-sm overflow-hidden">
                    <div class="aspect-video bg-gray-200 flex items-center justify-center text-gray-400 text-sm">Kad {{ $i + 1 }}</div>
                    <div class="p-6 space-y-2">
                        <input type="text" data-edit-field="title" value="{{ $a['title'] ?? '' }}" placeholder="Tajuk aktiviti" class="w-full text-lg font-semibold border border-gray-200 rounded px-2 py-1">
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" data-edit-field="date" value="{{ $a['date'] ?? '' }}" placeholder="Tarikh" class="rounded-md border border-gray-200 px-2 py-1 text-sm">
                            <input type="text" data-edit-field="location" value="{{ $a['location'] ?? '' }}" placeholder="Lokasi" class="rounded-md border border-gray-200 px-2 py-1 text-sm">
                        </div>
                        <textarea data-edit-field="desc" rows="2" placeholder="Penerangan" class="w-full text-sm text-gray-600 rounded-md border border-gray-200 px-2 py-1">{{ $a['desc'] ?? '' }}</textarea>
                    </div>
                    <div class="p-6 pt-0">
                        <span class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white h-9 px-4 text-gray-500">Maklumat Lanjut</span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-12">
                <span class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-300 bg-white h-10 px-6 text-gray-500">Lihat Galeri</span>
            </div>
        </div>
    </section>
</div>
