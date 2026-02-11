@extends('layouts.app')

@section('title', 'Aktiviti - Alumni 4B Malaysia')

@section('content')
@php $content = $content ?? []; $activities = $content['activities'] ?? []; @endphp
<div class="container mx-auto px-4 md:px-6 py-8">
    @include('partials.breadcrumb', ['items' => [['label' => 'Aktiviti']]])

    <div class="space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">{{ $content['title'] ?? 'Aktiviti Alumni 4B' }}</h1>
            <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
                {{ $content['subtitle'] ?? 'Senarai aktiviti dan program yang dianjurkan oleh Alumni 4B Malaysia di peringkat kebangsaan dan negeri.' }}
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($activities as $idx => $activity)
            <div class="rounded-lg border bg-white shadow-sm overflow-hidden">
                <div class="aspect-video bg-gray-200 flex items-center justify-center text-gray-500 text-sm">Aktiviti {{ $activity['id'] ?? ($idx + 1) }}</div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900">{{ $activity['title'] }}</h3>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $activity['date'] }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $activity['location'] }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            {{ $activity['participants'] }} peserta
                        </span>
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <p class="text-sm text-gray-600">{{ $activity['description'] }}</p>
                </div>
                <div class="p-4 pt-0">
                    <a href="{{ route('aktiviti.show', $activity['id'] ?? ($idx + 1)) }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 h-9 px-4">Maklumat Lanjut</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-center">
            <button type="button" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-300 bg-white hover:bg-gray-50 h-10 px-6">Lihat Aktiviti Sebelumnya</button>
        </div>

        <div class="bg-gray-100 rounded-lg p-6 mt-12">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">{{ $content['cadang_title'] ?? 'Cadangkan Aktiviti' }}</h2>
                <p class="text-gray-600 mt-2">{{ $content['cadang_subtitle'] ?? 'Anda mempunyai cadangan untuk aktiviti Alumni 4B? Sila hubungi kami.' }}</p>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('hubungi-kami') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 h-10 px-6">Hubungi Kami</a>
            </div>
        </div>
    </div>
</div>
@endsection
