@extends('layouts.app')

@section('title', 'Edit ' . ($slug === 'home' ? 'Laman Utama' : ucfirst(str_replace('-', ' ', $slug))) . ' - HQ')

@section('content')
@php
    $editWidth = $slug === 'home' ? 'w-full' : (in_array($slug, ['latar-belakang', 'carta-organisasi', 'aktiviti', 'galeri']) ? 'max-w-6xl mx-auto' : 'max-w-4xl mx-auto');
@endphp
<div class="{{ $editWidth }} px-4 mt-6 mb-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">Edit Halaman: {{ $slug === 'home' ? 'Laman Utama' : ucfirst(str_replace('-', ' ', $slug)) }}</h1>
            <p class="text-sm text-gray-600 mt-1">Ubah kandungan halaman awam. Pilih pratonton untuk melihat hasil.</p>
        </div>
        <div class="flex gap-2">
            @php
                $previewRoutes = ['home' => url('/'), 'latar-belakang' => route('latar-belakang'), 'carta-organisasi' => route('carta-organisasi'), 'aktiviti' => route('aktiviti.index'), 'galeri' => route('galeri')];
            @endphp
            <a href="{{ $previewRoutes[$slug] ?? url('/') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Pratonton
            </a>
            <a href="{{ route('hq.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-50">Kembali</a>
        </div>
    </div>

    @if(session('success'))
    <div class="rounded-lg border border-green-200 bg-green-50 p-4 mb-6 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('hq.edit-page.update', $slug) }}" class="space-y-6" enctype="{{ in_array($slug, ['galeri', 'carta-organisasi']) ? 'multipart/form-data' : 'application/x-www-form-urlencoded' }}">
        @csrf
        <input type="hidden" name="content" id="content-input">

        @include('pages.hq.edit-partials.' . $slug)

        <div class="flex gap-2 pt-4">
            <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-primary/90">Simpan</button>
            <a href="{{ route('hq.dashboard') }}" class="px-6 py-2 text-sm font-medium border border-gray-300 rounded-md hover:bg-gray-50">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    document.dispatchEvent(new CustomEvent('hq:sync-chart-tree'));
    const form = this;
    const data = {};
    form.querySelectorAll('[data-edit-key]').forEach(el => {
        const key = el.dataset.editKey;
        if (el.type === 'checkbox') {
            data[key] = el.checked;
        } else if (el.tagName === 'SELECT' && el.multiple) {
            data[key] = Array.from(el.selectedOptions).map(o => o.value);
        } else {
            data[key] = el.value;
        }
    });
    form.querySelectorAll('[data-edit-array]').forEach(container => {
        const key = container.dataset.editArray;
        const items = [];
        container.querySelectorAll('[data-edit-item]').forEach(itemEl => {
            const item = {};
            itemEl.querySelectorAll('[data-edit-field]').forEach(f => {
                let v = f.value;
                if (f.type === 'number' && v !== '') v = parseInt(v, 10);
                if (typeof v === 'string' && v.startsWith('dataurl:')) return;
                item[f.dataset.editField] = v;
            });
            items.push(item);
        });
        data[key] = items;
    });
    var treeData = null;
    var chartTreeEl = document.getElementById('chart-tree-input');
    if (chartTreeEl && chartTreeEl.value) {
        try { treeData = JSON.parse(chartTreeEl.value); } catch (_) {}
    }
    if (!treeData && typeof Alpine !== 'undefined') {
        var editorEl = document.getElementById('chart-tree-editor');
        if (editorEl) {
            var comp = Alpine.$data && Alpine.$data(editorEl);
            if (comp && comp.chartTree) treeData = comp.chartTree;
            else if (editorEl._x_dataStack && editorEl._x_dataStack[0] && editorEl._x_dataStack[0].chartTree)
                treeData = editorEl._x_dataStack[0].chartTree;
        }
    }
    if (treeData) {
        function stripPreview(nodes) {
            if (!nodes) return nodes;
            return (Array.isArray(nodes) ? nodes : [nodes]).map(function(n) {
                var rest = Object.assign({}, n);
                delete rest.preview;
                if (rest.children && rest.children.length) rest.children = stripPreview(rest.children);
                return rest;
            });
        }
        data.chart_tree = stripPreview(treeData);
    }
    const fd = new FormData(form);
    fd.set('content', JSON.stringify(data));
    fd.delete('chart_tree_json');
    const action = form.action;
    const btn = form.querySelector('button[type="submit"]');
    const origText = btn ? btn.textContent : '';
    if (btn) { btn.disabled = true; btn.textContent = 'Menyimpan...'; }
    fetch(action, {
        method: 'POST',
        body: fd,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => { if (r.ok || r.redirected) { window.location.href = r.redirected ? r.url : action; } else return r.text().then(t => { throw new Error(t || 'Simpan gagal'); }); })
    .catch(err => { alert(err.message || 'Ralat: ' + err); if (btn) { btn.disabled = false; btn.textContent = origText; } });
});
</script>
@endpush
@endsection
