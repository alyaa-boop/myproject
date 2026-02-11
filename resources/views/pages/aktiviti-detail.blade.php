@extends('layouts.app')

@section('title', 'Program Khidmat Masyarakat ' . $id . ' - Alumni 4B Malaysia')

@section('content')
<div class="container mx-auto px-4 md:px-6 py-12 md:py-24">
    <a href="{{ route('aktiviti.index') }}" class="text-primary hover:underline text-sm mb-4 inline-block">← Kembali ke Aktiviti</a>
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Program Khidmat Masyarakat {{ $id }}</h1>
    <p class="text-gray-500 mb-2">10 Jun 2025 • Kuala Lumpur</p>
    <p class="text-gray-600 max-w-3xl">Program khidmat masyarakat yang dianjurkan oleh Alumni 4B Kuala Lumpur dengan kerjasama pihak berkuasa tempatan. Kandungan penuh akan ditambah kemudian.</p>
</div>
@endsection
