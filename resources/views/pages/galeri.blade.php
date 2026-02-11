@extends('layouts.app')

@section('title', 'Galeri - Alumni 4B Malaysia')

@section('content')
@php
    $content = $content ?? [];
    $items = $content['items'] ?? [];
@endphp
<div class="container mx-auto px-4 md:px-6 py-12 md:py-16">
    <div class="mb-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $content['title'] ?? 'Galeri' }}</h1>
        <p class="text-gray-600 max-w-3xl">{{ $content['subtitle'] ?? 'Galeri gambar aktiviti dan program Alumni 4B Malaysia.' }}</p>
    </div>

    @if(count($items) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($items as $item)
        <article class="rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden hover:shadow-md transition-shadow">
            <div class="aspect-[4/3] bg-gray-100 overflow-hidden">
                @if(!empty($item['image']))
                <img src="{{ str_starts_with($item['image'] ?? '', 'http') ? $item['image'] : asset('storage/' . $item['image']) }}"
                     alt="{{ $item['caption'] ?? 'Galeri' }}"
                     class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif
            </div>
            <div class="p-5">
                @if(!empty($item['caption']))
                <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $item['caption'] }}</h2>
                @endif
                @if(!empty($item['details']))
                <p class="text-gray-600 text-sm leading-relaxed">{{ $item['details'] }}</p>
                @endif
            </div>
        </article>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 rounded-xl border-2 border-dashed border-gray-200 bg-gray-50">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-gray-500">Tiada gambar dalam galeri. Kandungan akan ditambah tidak lama lagi.</p>
    </div>
    @endif
</div>
@endsection
