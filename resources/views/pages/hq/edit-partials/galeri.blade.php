@php
    $c = $content ?? [];
    $items = $c['items'] ?? [];
@endphp
{{-- Edit view sama layout seperti laman Galeri (grid kad) --}}
<div class="container mx-auto px-4 md:px-6 py-12 md:py-16 rounded-lg border border-gray-200 bg-white">
    <div class="mb-12">
        <label class="block text-xs font-medium text-gray-500 mb-1">Tajuk Halaman</label>
        <input type="text" data-edit-key="title" value="{{ $c['title'] ?? 'Galeri' }}"
            class="w-full text-3xl font-bold text-gray-900 rounded-md border border-gray-200 px-3 py-2 focus:border-primary">
        <label class="block text-xs font-medium text-gray-500 mt-2 mb-1">Keterangan</label>
        <textarea data-edit-key="subtitle" rows="2" class="w-full text-gray-600 max-w-3xl rounded-md border border-gray-200 px-3 py-2 focus:border-primary">{{ $c['subtitle'] ?? 'Galeri gambar aktiviti dan program Alumni 4B Malaysia.' }}</textarea>
    </div>

    <div class="flex items-center justify-between mb-4">
        <span class="text-sm font-medium text-gray-700">Kad Galeri (seret untuk susun semula)</span>
        <button type="button" id="add-gallery-item" class="text-sm text-primary hover:underline font-medium">+ Tambah Kad</button>
    </div>

    <div id="gallery-sortable" data-edit-array="items" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($items as $idx => $item)
        <article class="gallery-item rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden hover:shadow-md transition-shadow" data-edit-item>
            <div class="flex gap-2 p-2 bg-gray-50 border-b">
                <span class="gallery-drag-handle cursor-grab active:cursor-grabbing text-gray-400" title="Seret untuk susun">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V4a2 2 0 012-2h2zm6 0a2 2 0 012 2v12a2 2 0 01-2 2h-2a2 2 0 01-2-2V4a2 2 0 012-2h2z"/></svg>
                </span>
                <button type="button" class="remove-gallery-item text-red-600 text-xs hover:underline ml-auto">Buang kad</button>
            </div>
            <div class="gallery-image-area aspect-[4/3] bg-gray-100 overflow-hidden flex items-center justify-center">
                @if(!empty($item['image']))
                <img src="{{ str_starts_with($item['image'] ?? '', 'http') ? $item['image'] : asset('storage/' . $item['image']) }}" alt="" class="w-full h-full object-cover gallery-preview">
                @else
                <span class="text-gray-400 text-sm text-center px-2">Pilih gambar</span>
                @endif
            </div>
            <div class="p-4">
                <input type="file" name="gallery_image_{{ $idx }}" accept="image/*" class="mb-3 text-xs w-full gallery-file">
                <input type="hidden" data-edit-field="image" value="{{ $item['image'] ?? '' }}">
                <label class="block text-xs font-medium text-gray-600 mb-1">Kapsyen</label>
                <input type="text" data-edit-field="caption" value="{{ $item['caption'] ?? '' }}" placeholder="Kapsyen gambar" class="w-full text-lg font-semibold text-gray-900 rounded border border-gray-200 px-2 py-1 mb-2 focus:border-primary">
                <label class="block text-xs font-medium text-gray-600 mb-1">Butiran</label>
                <textarea data-edit-field="details" rows="3" placeholder="Penerangan" class="w-full text-gray-600 text-sm rounded border border-gray-200 px-2 py-1 focus:border-primary">{{ $item['details'] ?? '' }}</textarea>
            </div>
        </article>
        @endforeach
    </div>

    <div id="gallery-empty" class="text-center py-16 rounded-xl border-2 border-dashed border-gray-200 bg-gray-50 {{ count($items) > 0 ? 'hidden' : '' }}">
        <p class="text-gray-500">Tiada kad galeri. Klik "Tambah Kad" untuk mula.</p>
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
        <article class="gallery-item rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden" data-edit-item>
            <div class="flex gap-2 p-2 bg-gray-50 border-b">
                <span class="gallery-drag-handle cursor-grab active:cursor-grabbing text-gray-400" title="Seret untuk susun">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V4a2 2 0 012-2h2zm6 0a2 2 0 012 2v12a2 2 0 01-2 2h-2a2 2 0 01-2-2V4a2 2 0 012-2h2z"/></svg>
                </span>
                <button type="button" class="remove-gallery-item text-red-600 text-xs hover:underline ml-auto">Buang kad</button>
            </div>
            <div class="gallery-image-area aspect-[4/3] bg-gray-100 overflow-hidden flex items-center justify-center">
                <span class="text-gray-400 text-sm">Pilih gambar</span>
            </div>
            <div class="p-4">
                <input type="file" name="gallery_image_${idx}" accept="image/*" class="mb-3 text-xs w-full gallery-file">
                <input type="hidden" data-edit-field="image" value="">
                <label class="block text-xs font-medium text-gray-600 mb-1">Kapsyen</label>
                <input type="text" data-edit-field="caption" placeholder="Kapsyen gambar" class="w-full text-lg font-semibold text-gray-900 rounded border border-gray-200 px-2 py-1 mb-2 focus:border-primary">
                <label class="block text-xs font-medium text-gray-600 mb-1">Butiran</label>
                <textarea data-edit-field="details" rows="3" placeholder="Penerangan" class="w-full text-gray-600 text-sm rounded border border-gray-200 px-2 py-1 focus:border-primary"></textarea>
            </div>
        </article>
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
                const wrap = e.target.closest('article');
                const imgArea = wrap?.querySelector('.gallery-image-area');
                if (imgArea) {
                    imgArea.querySelector('.gallery-preview')?.remove();
                    imgArea.querySelector('span')?.remove();
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.className = 'w-full h-full object-cover gallery-preview';
                    img.alt = '';
                    imgArea.appendChild(img);
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
