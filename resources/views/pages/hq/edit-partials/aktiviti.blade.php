@php $c = $content ?? []; @endphp
<div class="border border-gray-200 rounded-lg p-6 space-y-6 bg-white">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tajuk Halaman</label>
        <input type="text" data-edit-key="title" value="{{ $c['title'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
        <textarea data-edit-key="subtitle" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['subtitle'] ?? '' }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tajuk Bahagian Cadangkan Aktiviti</label>
        <input type="text" data-edit-key="cadang_title" value="{{ $c['cadang_title'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Cadangkan</label>
        <textarea data-edit-key="cadang_subtitle" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['cadang_subtitle'] ?? '' }}</textarea>
    </div>
    <h3 class="font-semibold">Senarai Aktiviti</h3>
    <div data-edit-array="activities" class="space-y-4">
        @foreach(($c['activities'] ?? []) as $a)
        <div data-edit-item class="p-4 border rounded-lg space-y-2">
            <input type="hidden" data-edit-field="id" value="{{ $a['id'] ?? '' }}">
            <input type="text" data-edit-field="title" value="{{ $a['title'] ?? '' }}" placeholder="Tajuk" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                <input type="text" data-edit-field="date" value="{{ $a['date'] ?? '' }}" placeholder="Tarikh" class="rounded-md border border-gray-300 px-3 py-2 text-sm">
                <input type="text" data-edit-field="location" value="{{ $a['location'] ?? '' }}" placeholder="Lokasi" class="rounded-md border border-gray-300 px-3 py-2 text-sm">
                <input type="number" data-edit-field="participants" value="{{ $a['participants'] ?? '' }}" placeholder="Peserta" class="rounded-md border border-gray-300 px-3 py-2 text-sm">
            </div>
            <textarea data-edit-field="description" rows="2" placeholder="Penerangan" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $a['description'] ?? '' }}</textarea>
        </div>
        @endforeach
    </div>
</div>
