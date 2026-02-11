@php
    $c = $content ?? [];
    $items = $c['items'] ?? [];
@endphp
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
        <div class="flex items-center justify-between mb-3">
            <label class="block text-sm font-medium text-gray-700">Kad Galeri (Seret untuk susun semula)</label>
            <button type="button" id="add-gallery-item" class="text-sm text-primary hover:underline font-medium">+ Tambah Kad</button>
        </div>
        <div id="gallery-sortable" class="space-y-4" data-edit-array="items">
            @foreach($items as $idx => $item)
            <div class="gallery-item border border-gray-200 rounded-lg p-4 bg-gray-50" data-edit-item>
                <div class="flex gap-4">
                    <div class="gallery-drag-handle flex-shrink-0 cursor-grab active:cursor-grabbing text-gray-400 pt-1" title="Seret untuk susun">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V4a2 2 0 012-2h2zm6 0a2 2 0 012 2v12a2 2 0 01-2 2h-2a2 2 0 01-2-2V4a2 2 0 012-2h2z"/></svg>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 rounded-lg bg-gray-200 overflow-hidden flex items-center justify-center">
                            @if(!empty($item['image']))
                            <img src="{{ str_starts_with($item['image'] ?? '', 'http') ? $item['image'] : asset('storage/' . $item['image']) }}" alt="" class="w-full h-full object-cover gallery-preview">
                            @else
                            <span class="text-gray-400 text-xs text-center px-2">Tiada gambar</span>
                            @endif
                        </div>
                        <input type="file" name="gallery_image_{{ $idx }}" accept="image/*" class="mt-2 text-xs gallery-file">
                        <input type="hidden" data-edit-field="image" value="{{ $item['image'] ?? '' }}">
                    </div>
                    <div class="flex-1 space-y-2">
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Kapsyen</label>
                            <input type="text" data-edit-field="caption" value="{{ $item['caption'] ?? '' }}" placeholder="Kapsyen gambar" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Butiran</label>
                            <textarea data-edit-field="details" rows="3" placeholder="Penerangan lengkap" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $item['details'] ?? '' }}</textarea>
                        </div>
                        <button type="button" class="remove-gallery-item text-red-600 text-xs hover:underline">Buang kad</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="gallery-empty" class="text-center py-8 text-gray-500 text-sm {{ count($items) > 0 ? 'hidden' : '' }}">
            Tiada kad galeri. Klik "Tambah Kad" untuk mula.
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
(function() {
    const container = document.getElementById('gallery-sortable');
    const emptyMsg = document.getElementById('gallery-empty');
    const addBtn = document.getElementById('add-gallery-item');

    const itemTemplate = (idx) => `
        <div class="gallery-item border border-gray-200 rounded-lg p-4 bg-gray-50" data-edit-item>
            <div class="flex gap-4">
                <div class="gallery-drag-handle flex-shrink-0 cursor-grab active:cursor-grabbing text-gray-400 pt-1" title="Seret untuk susun">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V4a2 2 0 012-2h2zm6 0a2 2 0 012 2v12a2 2 0 01-2 2h-2a2 2 0 01-2-2V4a2 2 0 012-2h2z"/></svg>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 rounded-lg bg-gray-200 overflow-hidden flex items-center justify-center">
                        <span class="text-gray-400 text-xs text-center px-2">Pilih gambar</span>
                    </div>
                    <input type="file" name="gallery_image_${idx}" accept="image/*" class="mt-2 text-xs gallery-file">
                    <input type="hidden" data-edit-field="image" value="">
                </div>
                <div class="flex-1 space-y-2">
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Kapsyen</label>
                        <input type="text" data-edit-field="caption" placeholder="Kapsyen gambar" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Butiran</label>
                        <textarea data-edit-field="details" rows="3" placeholder="Penerangan lengkap" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></textarea>
                    </div>
                    <button type="button" class="remove-gallery-item text-red-600 text-xs hover:underline">Buang kad</button>
                </div>
            </div>
        </div>
    `;

    addBtn?.addEventListener('click', function() {
        const count = container.querySelectorAll('[data-edit-item]').length;
        container.insertAdjacentHTML('beforeend', itemTemplate(count));
        emptyMsg?.classList.add('hidden');
        refreshFileInputNames();
    });

    container?.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-gallery-item')) {
            e.target.closest('[data-edit-item]').remove();
            refreshFileInputNames();
            if (container.querySelectorAll('[data-edit-item]').length === 0) {
                emptyMsg?.classList.remove('hidden');
            }
        }
    });

    container?.addEventListener('change', function(e) {
        if (e.target.classList.contains('gallery-file') && e.target.files?.[0]) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                const img = e.target.closest('.flex-shrink-0').querySelector('.gallery-preview');
                const placeholder = e.target.closest('.flex-shrink-0').querySelector('.flex.items-center.justify-center');
                if (img) {
                    img.src = reader.result;
                } else if (placeholder) {
                    placeholder.innerHTML = '<img src="' + reader.result + '" class="w-full h-full object-cover gallery-preview" alt="">';
                }
            };
            reader.readAsDataURL(file);
        }
    });

    function refreshFileInputNames() {
        container.querySelectorAll('[data-edit-item]').forEach((el, i) => {
            const fileInput = el.querySelector('.gallery-file');
            if (fileInput) fileInput.name = 'gallery_image_' + i;
        });
    }

    if (container && typeof Sortable !== 'undefined') {
        new Sortable(container, {
            animation: 150,
            handle: '.gallery-drag-handle',
            ghostClass: 'opacity-50',
            draggable: '[data-edit-item]'
        });
    }
})();
</script>
@endpush
