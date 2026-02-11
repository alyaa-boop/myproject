@extends('layouts.app')

@section('title', 'Latar Belakang - Alumni 4B Malaysia')

@section('content')
@php $content = $content ?? []; @endphp
<div class="container mx-auto px-4 md:px-6 py-8">
    @include('partials.breadcrumb', ['items' => [['label' => 'Latar Belakang']]])

    <div class="grid gap-8 md:grid-cols-3">
        <div class="md:col-span-2 space-y-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ $content['title'] ?? 'Latar Belakang Alumni 4B Malaysia' }}</h1>

            <div class="aspect-video bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-sm">
                Sejarah 4B
            </div>

            <div class="prose prose-gray max-w-none">
                <p class="text-gray-600">{{ $content['intro'] ?? 'Alumni 4B Malaysia merupakan sebuah pertubuhan yang ditubuhkan untuk menghimpunkan bekas ahli Pertubuhan Belia 4B Malaysia.' }}</p>

                <h2 class="text-xl font-bold mt-6 text-gray-900">{{ $content['sejarah_title'] ?? 'Sejarah Penubuhan' }}</h2>
                <p class="text-gray-600">{{ $content['sejarah_1'] ?? '' }}</p>
                <p class="text-gray-600">{{ $content['sejarah_2'] ?? '' }}</p>

                <h2 class="text-xl font-bold mt-6 text-gray-900">{{ $content['objektif_title'] ?? 'Objektif' }}</h2>
                <ul class="list-disc pl-6 text-gray-600 space-y-1">
                    @foreach(($content['objektif'] ?? []) as $obj)
                    <li>{{ $obj }}</li>
                    @endforeach
                </ul>

                <h2 class="text-xl font-bold mt-6 text-gray-900">{{ $content['struktur_title'] ?? 'Struktur Organisasi' }}</h2>
                <p class="text-gray-600">{{ $content['struktur'] ?? '' }}</p>

                <h2 class="text-xl font-bold mt-6 text-gray-900">{{ $content['keahlian_title'] ?? 'Keahlian' }}</h2>
                <p class="text-gray-600">{{ $content['keahlian'] ?? '' }}</p>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-lg border bg-white shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Maklumat Ringkas</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="font-medium text-gray-700">Tahun Penubuhan</p>
                        <p class="text-gray-600">{!! nl2br(e($content['tahun_penubuhan'] ?? '2010')) !!}</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Bilangan Ahli</p>
                        <p class="text-gray-600">{!! nl2br(e($content['bilangan_ahli'] ?? '10,000+ di seluruh Malaysia')) !!}</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Alamat Ibu Pejabat</p>
                        <p class="text-gray-600">{!! nl2br(e($content['alamat'] ?? 'Ibu Pejabat Alumni 4B Malaysia' . "\n" . 'Jalan Contoh, 50000 Kuala Lumpur')) !!}</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Hubungi Kami</p>
                        <p class="text-gray-600">{!! nl2br(e($content['hubungi'] ?? 'Tel: 03-1234 5678' . "\n" . 'Email: info@alumni4b.org.my')) !!}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border bg-white shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Dokumen Berkaitan</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-primary hover:underline">Perlembagaan Alumni 4B Malaysia</a></li>
                    <li><a href="#" class="text-primary hover:underline">Laporan Tahunan 2024</a></li>
                    <li><a href="#" class="text-primary hover:underline">Pelan Strategik 2025-2030</a></li>
                    <li><a href="#" class="text-primary hover:underline">Borang Keahlian</a></li>
                </ul>
            </div>

            <div class="rounded-lg border bg-white shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pautan Berkaitan</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-primary hover:underline">Pertubuhan Belia 4B Malaysia</a></li>
                    <li><a href="#" class="text-primary hover:underline">Kementerian Belia dan Sukan</a></li>
                    <li><a href="#" class="text-primary hover:underline">Majlis Belia Malaysia</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
