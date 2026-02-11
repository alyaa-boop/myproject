@extends('layouts.app')

@section('title', 'Portal Alumni 4B Malaysia')

@section('content')
@php $content = $content ?? []; @endphp
<div class="flex min-h-screen flex-col bg-white">
    {{-- Hero Section --}}
    <section class="w-full py-12 md:py-24 lg:py-32 bg-primary text-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid gap-6 lg:grid-cols-2 lg:gap-12 items-center">
                <div class="space-y-4">
                    <h1 class="text-3xl font-bold tracking-tight sm:text-4xl md:text-5xl">
                        {{ $content['hero_title'] ?? 'Selamat Datang ke Portal Alumni 4B Malaysia' }}
                    </h1>
                    <p class="md:text-xl text-white/90">
                        {{ $content['hero_subtitle'] ?? 'Menghubungkan semua bekas ahli 4B di seluruh Malaysia untuk terus menyumbang kepada pembangunan masyarakat dan negara.' }}
                    </p>
                    <div class="flex flex-col gap-2 min-[400px]:flex-row">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-white text-primary hover:bg-gray-100 h-11 px-8">
                            Daftar Keahlian
                        </a>
                        <a href="{{ route('semakan-keahlian') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium border-2 border-white text-white hover:bg-white/10 h-11 px-8">
                            Semak Keahlian
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Alumni%20Logo-HUJe1PdYiSPMjJRbCOIcxHYXnPhDBV.png" alt="Alumni 4B Logo" class="w-64 h-64 md:w-72 md:h-72 rounded-full bg-white p-4 object-contain">
                </div>
            </div>
        </div>
    </section>

    {{-- Perkhidmatan Kami --}}
    <section class="w-full py-12 md:py-24 lg:py-32 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col items-center justify-center space-y-4 text-center mb-12">
                <div class="space-y-2">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-5xl text-gray-900">{{ $content['services_title'] ?? 'Perkhidmatan Kami' }}</h2>
                    <p class="max-w-[900px] text-gray-600 md:text-xl/relaxed">
                        {{ $content['services_subtitle'] ?? 'Portal Alumni 4B menyediakan pelbagai perkhidmatan untuk memudahkan bekas ahli 4B untuk terus berhubung dan menyumbang.' }}
                    </p>
                </div>
            </div>
            <div class="mx-auto grid max-w-5xl items-stretch gap-6 md:grid-cols-2 lg:grid-cols-3">
                {{-- Keahlian --}}
                <div class="rounded-lg border bg-white shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 flex flex-row items-center gap-4 border-b">
                        <svg class="h-8 w-8 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <div>
                            <h3 class="text-lg font-semibold">{{ $content['keahlian_title'] ?? 'Keahlian' }}</h3>
                            <p class="text-sm text-gray-500">{{ $content['keahlian_subtitle'] ?? 'Daftar dan semak status keahlian anda' }}</p>
                        </div>
                    </div>
                    <div class="p-6 flex-1">
                        <p class="text-sm text-gray-600">
                            {{ $content['keahlian_desc'] ?? 'Sistem pengurusan keahlian yang komprehensif untuk memudahkan pendaftaran dan pengesahan keahlian alumni.' }}
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="{{ route('semakan-keahlian') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-200 bg-white hover:bg-gray-50 h-9 px-4 w-full">
                            Ketahui Lebih Lanjut
                        </a>
                    </div>
                </div>
                {{-- Aktiviti --}}
                <div class="rounded-lg border bg-white shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 flex flex-row items-center gap-4 border-b">
                        <svg class="h-8 w-8 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z"/></svg>
                        <div>
                            <h3 class="text-lg font-semibold">{{ $content['aktiviti_title'] ?? 'Aktiviti' }}</h3>
                            <p class="text-sm text-gray-500">{{ $content['aktiviti_subtitle'] ?? 'Program dan aktiviti terkini' }}</p>
                        </div>
                    </div>
                    <div class="p-6 flex-1">
                        <p class="text-sm text-gray-600">
                            {{ $content['aktiviti_desc'] ?? 'Maklumat mengenai program dan aktiviti yang dianjurkan oleh Alumni 4B di peringkat kebangsaan dan negeri.' }}
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="{{ route('aktiviti.index') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-200 bg-white hover:bg-gray-50 h-9 px-4">
                            Lihat Aktiviti
                        </a>
                    </div>
                </div>
                {{-- Galeri --}}
                <div class="rounded-lg border bg-white shadow-sm overflow-hidden flex flex-col md:col-span-2 lg:col-span-1">
                    <div class="p-6 flex flex-row items-center gap-4 border-b">
                        <svg class="h-8 w-8 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <div>
                            <h3 class="text-lg font-semibold">{{ $content['galeri_title'] ?? 'Galeri' }}</h3>
                            <p class="text-sm text-gray-500">{{ $content['galeri_subtitle'] ?? 'Koleksi gambar aktiviti' }}</p>
                        </div>
                    </div>
                    <div class="p-6 flex-1">
                        <p class="text-sm text-gray-600">
                            {{ $content['galeri_desc'] ?? 'Galeri gambar aktiviti dan program yang telah dijalankan oleh Alumni 4B di seluruh Malaysia.' }}
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="{{ route('galeri') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-200 bg-white hover:bg-gray-50 h-9 px-4">
                            Lihat Galeri
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Aktiviti Terkini --}}
    <section class="w-full py-12 md:py-24 lg:py-32 bg-gray-100">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col items-center justify-center space-y-4 text-center mb-12">
                <div class="space-y-2">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-5xl text-gray-900">{{ $content['latest_title'] ?? 'Aktiviti Terkini' }}</h2>
                    <p class="max-w-[900px] text-gray-600 md:text-xl/relaxed">
                        {{ $content['latest_subtitle'] ?? 'Sertai aktiviti-aktiviti terkini yang dianjurkan oleh Alumni 4B di seluruh Malaysia.' }}
                    </p>
                </div>
            </div>
            <div class="mx-auto grid max-w-5xl gap-8 md:grid-cols-2">
                @foreach($galleryItems ?? [] as $i => $item)
                <div class="rounded-lg border bg-white shadow-sm overflow-hidden">
                    <div class="aspect-video bg-gray-200 overflow-hidden">
                        @if(!empty($item['image']))
                        <img src="{{ str_starts_with($item['image'] ?? '', 'http') ? $item['image'] : asset('storage/' . $item['image']) }}"
                             alt="{{ $item['caption'] ?? 'Aktiviti' }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 font-medium">
                            Aktiviti {{ $i + 1 }}
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold">{{ $item['caption'] ?? 'Aktiviti' }}</h3>
                        <p class="mt-4 text-sm text-gray-600">
                            {{ $item['details'] ?? '' }}
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="{{ route('galeri') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 h-9 px-4">
                            Maklumat Lanjut
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-12">
                <a href="{{ route('galeri') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-300 bg-white hover:bg-gray-50 h-10 px-6">
                    Lihat Galeri
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
