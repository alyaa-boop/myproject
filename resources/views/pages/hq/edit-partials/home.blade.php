@php $c = $content ?? []; @endphp
<div class="border border-gray-200 rounded-lg p-6 space-y-6 bg-white">
    <h2 class="text-lg font-semibold border-b pb-2">Bahagian Hero</h2>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tajuk</label>
        <input type="text" data-edit-key="hero_title" value="{{ $c['hero_title'] ?? '' }}"
            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Sari Kata</label>
        <textarea data-edit-key="hero_subtitle" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['hero_subtitle'] ?? '' }}</textarea>
    </div>

    <h2 class="text-lg font-semibold border-b pb-2 mt-8">Perkhidmatan Kami</h2>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tajuk Seksyen</label>
        <input type="text" data-edit-key="services_title" value="{{ $c['services_title'] ?? '' }}"
            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
        <textarea data-edit-key="services_subtitle" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['services_subtitle'] ?? '' }}</textarea>
    </div>

    <h3 class="font-medium mt-4">Kad Keahlian</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-gray-600 mb-1">Tajuk</label>
            <input type="text" data-edit-key="keahlian_title" value="{{ $c['keahlian_title'] ?? '' }}"
                class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1">Sari kata</label>
            <input type="text" data-edit-key="keahlian_subtitle" value="{{ $c['keahlian_subtitle'] ?? '' }}"
                class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm text-gray-600 mb-1">Penerangan</label>
            <textarea data-edit-key="keahlian_desc" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['keahlian_desc'] ?? '' }}</textarea>
        </div>
    </div>

    <h3 class="font-medium mt-4">Kad Aktiviti</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block text-sm text-gray-600 mb-1">Tajuk</label>
            <input type="text" data-edit-key="aktiviti_title" value="{{ $c['aktiviti_title'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">Sari kata</label>
            <input type="text" data-edit-key="aktiviti_subtitle" value="{{ $c['aktiviti_subtitle'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div class="md:col-span-2"><label class="block text-sm text-gray-600 mb-1">Penerangan</label>
            <textarea data-edit-key="aktiviti_desc" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['aktiviti_desc'] ?? '' }}</textarea></div>
    </div>

    <h3 class="font-medium mt-4">Kad Galeri</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block text-sm text-gray-600 mb-1">Tajuk</label>
            <input type="text" data-edit-key="galeri_title" value="{{ $c['galeri_title'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">Sari kata</label>
            <input type="text" data-edit-key="galeri_subtitle" value="{{ $c['galeri_subtitle'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div class="md:col-span-2"><label class="block text-sm text-gray-600 mb-1">Penerangan</label>
            <textarea data-edit-key="galeri_desc" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['galeri_desc'] ?? '' }}</textarea></div>
    </div>

    <h2 class="text-lg font-semibold border-b pb-2 mt-8">Aktiviti Terkini</h2>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tajuk</label>
        <input type="text" data-edit-key="latest_title" value="{{ $c['latest_title'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
        <textarea data-edit-key="latest_subtitle" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['latest_subtitle'] ?? '' }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Kad Aktiviti (maks 4)</label>
        <div data-edit-array="activities" class="space-y-4">
            @foreach(($c['activities'] ?? []) as $i => $a)
            <div data-edit-item class="p-4 border rounded-lg space-y-2">
                <input type="text" data-edit-field="title" value="{{ $a['title'] ?? '' }}" placeholder="Tajuk" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                <div class="grid grid-cols-2 gap-2">
                    <input type="text" data-edit-field="date" value="{{ $a['date'] ?? '' }}" placeholder="Tarikh" class="rounded-md border border-gray-300 px-3 py-2 text-sm">
                    <input type="text" data-edit-field="location" value="{{ $a['location'] ?? '' }}" placeholder="Lokasi" class="rounded-md border border-gray-300 px-3 py-2 text-sm">
                </div>
                <textarea data-edit-field="desc" rows="2" placeholder="Penerangan" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $a['desc'] ?? '' }}</textarea>
            </div>
            @endforeach
        </div>
    </div>
</div>
