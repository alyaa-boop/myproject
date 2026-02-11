@extends('layouts.app')

@section('title', 'Log Masuk - Alumni 4B Malaysia')

@section('content')
<div class="container mx-auto px-4 md:px-6 py-8">
    @include('partials.breadcrumb', ['items' => [['label' => 'Log Masuk']]])

    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Log Masuk</h1>
            <p class="text-gray-600 mt-2">Log masuk untuk mengakses akaun Alumni 4B anda.</p>
        </div>

        <div class="rounded-lg border bg-white shadow-sm overflow-hidden" x-data="loginForm">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Log Masuk</h2>
                <p class="text-sm text-gray-500">Masukkan e-mel dan kata laluan anda untuk log masuk.</p>
            </div>
            <div class="p-6">
                <div x-show="error" x-cloak class="rounded-lg border border-red-200 bg-red-50 p-4 mb-4 text-sm text-red-700" x-text="error"></div>

                @if(session('error'))
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 mb-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-4" x-data="{ isLoading: false }"
                @submit="isLoading = true">
                    @csrf
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-gray-700">Alamat E-mel</label>
                        <input type="email" name="email" id="email" required 
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-sm font-medium text-gray-700">Kata Laluan</label>
                            <a href="#" class="text-xs text-primary hover:underline">Lupa kata laluan?</a>
                        </div>
                        <input type="password" name="password" id="password" required 
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" x-model="form.rememberMe" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Ingat saya</span>
                    </label>
                    <button type="submit" :disabled="isLoading" class="w-full inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 disabled:opacity-50 h-10">
                        <span x-show="!isLoading">Log Masuk</span>
                        <span x-show="isLoading" class="flex items-center gap-2">
                            <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Log Masuk...
                        </span>
                    </button>
                </form>
            </div>
            <div class="p-6 border-t bg-gray-50 text-center text-sm text-gray-600">
                Belum menjadi ahli? <a href="{{ route('register') }}" class="text-primary hover:underline">Daftar sekarang</a>
            </div>
        </div>
    </div>
</div>

@endsection
