<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal Alumni 4B Malaysia - Menghubungkan bekas ahli 4B di seluruh Malaysia">
    <title>@yield('title', 'Alumni 4B Malaysia')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#242e81',
                        'primary-foreground': '#ffffff',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="antialiased bg-white text-gray-900 min-h-screen flex flex-col">
@if(session()->has('user'))
    {{-- Logged-in Header --}}
    <header class="sticky top-0 z-40 bg-primary text-white" x-data="{ editPagesOpen: false }">
        <div class="container mx-auto flex h-16 items-center justify-between px-6">

            {{-- Left: Logo + Title (clickable for HQ to open edit pages popup) --}}
            <div class="flex items-center gap-3">
                @if(session('user.role') === 'hq')
                <button type="button" @click="editPagesOpen = true" class="flex items-center gap-3 hover:opacity-90 transition cursor-pointer text-left">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Alumni%20Logo-HUJe1PdYiSPMjJRbCOIcxHYXnPhDBV.png"
                         alt="Alumni 4B Logo"
                         class="h-9 w-9 rounded-full bg-white p-1">
                @else
                <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-90 transition">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Alumni%20Logo-HUJe1PdYiSPMjJRbCOIcxHYXnPhDBV.png"
                         alt="Alumni 4B Logo"
                         class="h-9 w-9 rounded-full bg-white p-1">
                @endif
                <div class="leading-tight">
                    <div class="text-sm font-semibold">Alumni 4B Malaysia</div>
                    <div class="text-xs text-white/70">
                    @if(session('user.role') === 'hq')
                        Pentadbir HQ
                    @elseif(session('user.role') === 'setiausaha')
                        Setiausaha {{ session('user.state') ? \App\Models\Keahlian::namaNegeri(session('user.state')) : 'Negeri' }}
                    @else
                        Ahli
                    @endif
                    </div>
                </div>
                @if(session('user.role') === 'hq')
                </button>
                @else
                </a>
                @endif
            </div>

            {{-- HQ Edit Pages Popup --}}
            @if(session('user.role') === 'hq')
            <div x-show="editPagesOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4"
                 @keydown.escape.window="editPagesOpen=false" @click.self="editPagesOpen=false">
                <div class="w-full max-w-md rounded-lg bg-white shadow-xl border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-200 flex items-center justify-between bg-primary text-white">
                        <h3 class="font-semibold text-lg">Edit Halaman Awam</h3>
                        <button type="button" class="p-2 hover:bg-white/10 rounded" @click="editPagesOpen=false" aria-label="Tutup">✕</button>
                    </div>
                    <div class="p-4 space-y-2">
                        <a href="{{ route('hq.edit-page', 'home') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-800">
                            <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Laman Utama
                        </a>
                        <a href="{{ route('hq.edit-page', 'latar-belakang') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-800">
                            <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            Latar Belakang
                        </a>
                        <a href="{{ route('hq.edit-page', 'carta-organisasi') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-800">
                            <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            Carta Organisasi
                        </a>
                        <a href="{{ route('hq.edit-page', 'aktiviti') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-800">
                            <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Aktiviti
                        </a>
                        <a href="{{ route('hq.edit-page', 'galeri') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-800">
                            <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Galeri
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- Center: Dashboard Menu --}}
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">

                {{-- HQ MENU --}}
                @if(session('user.role') === 'hq')

                    <a href="{{ url('/') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Home --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 9.75L12 4.5l9 5.25v9a.75.75 0 01-.75.75H3.75A.75.75 0 013 18.75v-9z"/>
                        </svg>
                        Laman Utama
                    </a>

                    <a href="{{ route('hq.dashboard') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Dashboard --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3v18h18M9 17V9m4 8V5m4 12v-6"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('hq.pengesahan') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Pengesahan --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7.5 4.5v9L12 21l-7.5-4.5v-9L12 3z"/>
                        </svg>
                        Pengesahan
                    </a>

                    <a href="{{ route('hq.laporan') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Laporan --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17v-6m4 6V7m4 10v-4M3 3v18h18"/>
                        </svg>
                        Laporan
                    </a>

                    <a href="{{ route('hq.senarai-ahli') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Senarai Ahli --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20H4v-2a4 4 0 014-4h1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a3 3 0 100-6 3 3 0 000 6z"/>
                        </svg>
                        Senarai Ahli
                    </a>

                {{-- SETIAUSAHA MENU --}}
                @else

                    <a href="{{ url('/') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Home --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 9.75L12 4.5l9 5.25v9a.75.75 0 01-.75.75H3.75A.75.75 0 013 18.75v-9z"/>
                        </svg>
                        Laman Utama
                    </a>

                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Dashboard --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3v18h18M9 17V9m4 8V5m4 12v-6"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('register') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Daftar Ahli --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 21v-1a4 4 0 00-4-4H10a4 4 0 00-4 4v1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 8v6m3-3h-6"/>
                        </svg>
                        Daftar Ahli
                    </a>

                    <a href="{{ route('pengesahan') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Pengesahan --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7.5 4.5v9L12 21l-7.5-4.5v-9L12 3z"/>
                        </svg>
                        Pengesahan
                    </a>

                    <a href="{{ route('senarai-ahli') }}" class="flex items-center gap-2 hover:text-white/80">
                        {{-- Senarai Ahli --}}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20H4v-2a4 4 0 014-4h1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a3 3 0 100-6 3 3 0 000 6z"/>
                        </svg>
                        Senarai Ahli
                    </a>

                @endif
            </nav>



            {{-- Right: Pengurusan Pengguna (HQ only) + Logout --}}
            <div class="flex items-center gap-4">
                @if(session('user.role') === 'hq')
                <a href="{{ route('hq.pengurusan-pengguna') }}" class="flex items-center gap-2 text-sm font-medium hover:text-white/80">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                    </svg>
                    Pengurusan Pengguna
                </a>
                @endif
                <a href="{{ route('logout') }}" class="flex items-center gap-2 text-sm font-medium hover:text-white/80">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9l3 3-3 3m3-3H3"/>
                    </svg>
                    Log Keluar
                </a>
            </div>

        </div>
    </header>

@else
    {{-- Main Nav --}}
    <header class="sticky top-0 z-40 border-b bg-primary text-white">
        <div class="container mx-auto flex h-16 items-center justify-between px-4 md:px-6 py-4">
            <div class="flex items-center gap-2">
                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Alumni%20Logo-HUJe1PdYiSPMjJRbCOIcxHYXnPhDBV.png" alt="Alumni 4B Logo" class="h-10 w-10 rounded-full bg-white p-1 object-contain">
                <h1 class="text-xl font-bold">Alumni 4B Malaysia</h1>
            </div>

            {{-- Mobile menu button --}}
            <button type="button" class="md:hidden p-2" aria-label="Open menu" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            {{-- Desktop navigation --}}
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ url('/') }}" class="text-sm font-medium hover:text-white/80">Utama</a>
                <a href="{{ route('latar-belakang') }}" class="text-sm font-medium text-white/70 hover:text-white">Latar Belakang</a>
                <a href="{{ route('carta-organisasi') }}" class="text-sm font-medium text-white/70 hover:text-white">Carta Organisasi</a>
                <a href="{{ route('aktiviti.index') }}" class="text-sm font-medium text-white/70 hover:text-white">Aktiviti</a>
                <a href="{{ route('galeri') }}" class="text-sm font-medium text-white/70 hover:text-white">Galeri</a>
                <a href="{{ route('semakan-keahlian') }}" class="text-sm font-medium text-white/70 hover:text-white">Semakan Keahlian</a>
            </nav>

            {{-- Desktop auth buttons --}}
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-white text-white hover:bg-white/10 h-9 px-4">Log Masuk</a>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-white text-primary hover:bg-gray-100 h-9 px-4">Daftar Keahlian</a>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/20 bg-primary">
            <div class="container mx-auto py-4 px-4 flex flex-col space-y-4">
                <a href="{{ url('/') }}" class="text-sm font-medium py-2 hover:text-white/80">Utama</a>
                <a href="{{ route('latar-belakang') }}" class="text-sm font-medium py-2 text-white/70 hover:text-white">Latar Belakang</a>
                <a href="{{ route('carta-organisasi') }}" class="text-sm font-medium py-2 text-white/70 hover:text-white">Carta Organisasi</a>
                <a href="{{ route('galeri') }}" class="text-sm font-medium py-2 text-white/70 hover:text-white">Galeri</a>
                <a href="{{ route('aktiviti.index') }}" class="text-sm font-medium py-2 text-white/70 hover:text-white">Aktiviti</a>
                <a href="{{ route('semakan-keahlian') }}" class="text-sm font-medium py-2 text-white/70 hover:text-white">Semakan Keahlian</a>
                <div class="flex gap-2 pt-2">
                    <a href="{{ route('login') }}" class="flex-1 inline-flex items-center justify-center rounded-md text-sm font-medium border border-white text-white hover:bg-white/10 h-9">Log Masuk</a>
                    <a href="{{ route('register') }}" class="flex-1 inline-flex items-center justify-center rounded-md text-sm font-medium bg-white text-primary hover:bg-gray-100 h-9">Daftar Keahlian</a>
                </div>
            </div>
        </div>
    </header>
@endif

    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Site Footer --}}
    <footer class="border-t bg-primary text-white">
        <div class="container mx-auto flex flex-col gap-6 py-8 md:py-12 px-4 md:px-6">
            <div class="flex flex-col md:flex-row items-center justify-between mb-4">
                <div class="flex items-center gap-2 mb-4 md:mb-0">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Alumni%20Logo-HUJe1PdYiSPMjJRbCOIcxHYXnPhDBV.png" alt="Alumni 4B Logo" class="h-14 w-14 rounded-full bg-white p-1 object-contain">
                    <h2 class="text-xl font-bold">Alumni 4B Malaysia</h2>
                </div>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white/80" aria-label="Facebook"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                    <a href="#" class="hover:text-white/80" aria-label="Twitter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
                    <a href="#" class="hover:text-white/80" aria-label="Instagram"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
                </div>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-4">
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Tentang Kami</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('latar-belakang') }}" class="hover:text-white/80">Latar Belakang</a></li>
                        <li><a href="{{ route('carta-organisasi') }}" class="hover:text-white/80">Carta Organisasi</a></li>
                        <li><a href="{{ route('hubungi-kami') }}" class="hover:text-white/80">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Perkhidmatan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('semakan-keahlian') }}" class="hover:text-white/80">Semakan Keahlian</a></li>
                        <li><a href="{{ route('aktiviti.index') }}" class="hover:text-white/80">Aktiviti</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-white/80">Galeri</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Keahlian</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('register') }}" class="hover:text-white/80">Daftar Keahlian</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white/80">Log Masuk</a></li>
                        <li><a href="{{ route('semakan-keahlian') }}" class="hover:text-white/80">Semak Status</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm text-white/90">
                        <li>Ibu Pejabat Alumni 4B Malaysia</li>
                        <li>Jalan Contoh, 50000 Kuala Lumpur</li>
                        <li>Tel: 03-1234 5678</li>
                        <li>Email: info@alumni4b.org.my</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/20 pt-6 mt-2">
                <p class="text-sm text-center">© {{ date('Y') }} Alumni 4B Malaysia. Hak Cipta Terpelihara.</p>
            </div>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
