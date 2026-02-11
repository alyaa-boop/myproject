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
    const data = {};
    this.querySelectorAll('[data-edit-key]').forEach(el => {
        const key = el.dataset.editKey;
        if (el.type === 'checkbox') {
            data[key] = el.checked;
        } else if (el.tagName === 'SELECT' && el.multiple) {
            data[key] = Array.from(el.selectedOptions).map(o => o.value);
        } else {
            data[key] = el.value;
        }
    });
    this.querySelectorAll('[data-edit-array]').forEach(container => {
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
    var chartTreeEl = document.getElementById('chart-tree-input');
    if (chartTreeEl && chartTreeEl.value) {
        try {
            var tree = JSON.parse(chartTreeEl.value);
            function stripPreview(nodes) {
                if (!nodes) return nodes;
                return (Array.isArray(nodes) ? nodes : [nodes]).map(function(n) {
                    var rest = Object.assign({}, n);
                    delete rest.preview;
                    if (rest.children && rest.children.length) rest.children = stripPreview(rest.children);
                    return rest;
                });
            }
            data.chart_tree = stripPreview(tree);
        } catch (_) {}
    }
    document.getElementById('content-input').value = JSON.stringify(data);
});
</script>
@endpush
@endsection
