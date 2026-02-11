@extends('layouts.app')

@section('title', 'Latar Belakang - Alumni 4B Malaysia')

@section('content')
<div class="container mx-auto px-4 md:px-6 py-8">
    @include('partials.breadcrumb', ['items' => [['label' => 'Latar Belakang']]])

    <div class="grid gap-8 md:grid-cols-3">
        <div class="md:col-span-2 space-y-6">
            <h1 class="text-3xl font-bold text-gray-900">Latar Belakang Alumni 4B Malaysia</h1>

            <div class="aspect-video bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-sm">
                Sejarah 4B
            </div>

            <div class="prose prose-gray max-w-none">
                <p class="text-gray-600">
                    Alumni 4B Malaysia merupakan sebuah pertubuhan yang ditubuhkan untuk menghimpunkan bekas ahli Pertubuhan Belia 4B Malaysia. Pertubuhan ini bertujuan untuk mengekalkan semangat kesukarelawanan dan khidmat masyarakat dalam kalangan bekas ahli 4B.
                </p>

                <h2 class="text-xl font-bold mt-6 text-gray-900">Sejarah Penubuhan</h2>
                <p class="text-gray-600">
                    Pertubuhan Belia 4B Malaysia telah ditubuhkan pada tahun 1967 dengan matlamat untuk memupuk semangat kepimpinan, kesukarelawanan dan khidmat masyarakat dalam kalangan belia Malaysia. Setelah lebih 50 tahun penubuhannya, ramai bekas ahli 4B yang telah menyumbang kepada pembangunan masyarakat dan negara dalam pelbagai bidang.
                </p>
                <p class="text-gray-600">
                    Pada tahun 2010, Alumni 4B Malaysia telah ditubuhkan secara rasmi untuk menghimpunkan bekas ahli 4B dan meneruskan semangat kesukarelawanan dan khidmat masyarakat yang telah dipupuk semasa mereka menjadi ahli 4B.
                </p>

                <h2 class="text-xl font-bold mt-6 text-gray-900">Objektif</h2>
                <ul class="list-disc pl-6 text-gray-600 space-y-1">
                    <li>Menghimpunkan bekas ahli Pertubuhan Belia 4B Malaysia</li>
                    <li>Meneruskan semangat kesukarelawanan dan khidmat masyarakat</li>
                    <li>Menyokong aktiviti dan program Pertubuhan Belia 4B Malaysia</li>
                    <li>Menjadi platform untuk bekas ahli 4B berkongsi pengalaman dan kepakaran</li>
                    <li>Menyumbang kepada pembangunan masyarakat dan negara</li>
                </ul>

                <h2 class="text-xl font-bold mt-6 text-gray-900">Struktur Organisasi</h2>
                <p class="text-gray-600">
                    Alumni 4B Malaysia diuruskan oleh satu Jawatankuasa Pusat yang dipilih setiap 2 tahun dalam Mesyuarat Agung. Di peringkat negeri pula, terdapat Jawatankuasa Negeri yang menguruskan aktiviti dan program di peringkat negeri.
                </p>

                <h2 class="text-xl font-bold mt-6 text-gray-900">Keahlian</h2>
                <p class="text-gray-600">
                    Keahlian Alumni 4B Malaysia terbuka kepada semua bekas ahli Pertubuhan Belia 4B Malaysia. Ahli perlu mendaftar dan membayar yuran keahlian untuk menjadi ahli yang sah.
                </p>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-lg border bg-white shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Maklumat Ringkas</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="font-medium text-gray-700">Tahun Penubuhan</p>
                        <p class="text-gray-600">2010</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Bilangan Ahli</p>
                        <p class="text-gray-600">10,000+ di seluruh Malaysia</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Alamat Ibu Pejabat</p>
                        <p class="text-gray-600">Ibu Pejabat Alumni 4B Malaysia<br>Jalan Contoh, 50000 Kuala Lumpur</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-700">Hubungi Kami</p>
                        <p class="text-gray-600">Tel: 03-1234 5678<br>Email: info@alumni4b.org.my</p>
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
