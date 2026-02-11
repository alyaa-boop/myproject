@php
    $c = $content ?? [];
    $activities = $c['activities'] ?? [];
@endphp
{{-- Edit view sama layout seperti laman Aktiviti --}}
<div class="container mx-auto px-4 md:px-6 py-8 rounded-lg border border-gray-200 bg-white">
    <div class="space-y-8">
        <div class="text-center">
            <label class="block text-xs font-medium text-gray-500 mb-1">Tajuk Halaman</label>
            <input type="text" data-edit-key="title" value="{{ $c['title'] ?? 'Aktiviti Alumni 4B' }}"
                class="w-full text-center text-3xl font-bold text-gray-900 rounded-md border border-gray-200 px-3 py-2 max-w-2xl mx-auto block focus:border-primary">
            <label class="block text-xs font-medium text-gray-500 mt-4 mb-1">Keterangan</label>
            <textarea data-edit-key="subtitle" rows="2" class="w-full text-center text-gray-600 rounded-md border border-gray-200 px-3 py-2 max-w-2xl mx-auto block focus:border-primary">{{ $c['subtitle'] ?? 'Senarai aktiviti dan program yang dianjurkan oleh Alumni 4B Malaysia di peringkat kebangsaan dan negeri.' }}</textarea>
        </div>

        <div data-edit-array="activities" class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($activities as $idx => $activity)
            <div data-edit-item class="rounded-lg border bg-white shadow-sm overflow-hidden">
                <div class="aspect-video bg-gray-200 flex items-center justify-center text-gray-500 text-sm">Aktiviti {{ $activity['id'] ?? ($idx + 1) }}</div>
                <div class="p-4">
                    <input type="hidden" data-edit-field="id" value="{{ $activity['id'] ?? ($idx + 1) }}">
                    <input type="text" data-edit-field="title" value="{{ $activity['title'] ?? '' }}" placeholder="Tajuk aktiviti" class="w-full font-semibold text-gray-900 rounded border border-gray-200 px-2 py-1 focus:border-primary">
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2">
                        <input type="text" data-edit-field="date" value="{{ $activity['date'] ?? '' }}" placeholder="Tarikh" class="w-32 text-sm rounded border border-gray-200 px-2 py-1 focus:border-primary">
                        <input type="text" data-edit-field="location" value="{{ $activity['location'] ?? '' }}" placeholder="Lokasi" class="w-28 text-sm rounded border border-gray-200 px-2 py-1 focus:border-primary">
                        <input type="number" data-edit-field="participants" value="{{ $activity['participants'] ?? '' }}" placeholder="Peserta" class="w-20 text-sm rounded border border-gray-200 px-2 py-1 focus:border-primary">
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <textarea data-edit-field="description" rows="2" placeholder="Penerangan" class="w-full text-sm text-gray-600 rounded border border-gray-200 px-2 py-1 focus:border-primary">{{ $activity['description'] ?? '' }}</textarea>
                </div>
                <div class="p-4 pt-0">
                    <span class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white h-9 px-4">Maklumat Lanjut</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-center">
            <span class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-300 bg-white h-10 px-6 text-gray-500">Lihat Aktiviti Sebelumnya</span>
        </div>

        <div class="bg-gray-100 rounded-lg p-6 mt-12">
            <div class="text-center mb-6">
                <label class="block text-xs font-medium text-gray-500 mb-1">Tajuk Bahagian</label>
                <input type="text" data-edit-key="cadang_title" value="{{ $c['cadang_title'] ?? 'Cadangkan Aktiviti' }}"
                    class="w-full text-center text-2xl font-bold text-gray-900 rounded-md border border-gray-200 px-3 py-2 max-w-xl mx-auto block focus:border-primary">
                <label class="block text-xs font-medium text-gray-500 mt-2 mb-1">Keterangan</label>
                <textarea data-edit-key="cadang_subtitle" rows="2" class="w-full text-center text-gray-600 rounded-md border border-gray-200 px-3 py-2 max-w-xl mx-auto block focus:border-primary">{{ $c['cadang_subtitle'] ?? 'Anda mempunyai cadangan untuk aktiviti Alumni 4B? Sila hubungi kami.' }}</textarea>
            </div>
            <div class="flex justify-center">
                <span class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white h-10 px-6">Hubungi Kami</span>
            </div>
        </div>
    </div>
</div>
