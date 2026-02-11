@extends('layouts.app')

@section('title', 'Carta Organisasi - Alumni 4B Malaysia')

@section('content')
<div class="container mx-auto px-4 md:px-6 py-8">
    @include('partials.breadcrumb', ['items' => [['label' => 'Carta Organisasi']]])

    <div class="space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Carta Organisasi Alumni 4B Malaysia</h1>
            <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
                Struktur organisasi Alumni 4B Malaysia yang menguruskan aktiviti dan program di peringkat kebangsaan dan negeri.
            </p>
        </div>

        {{-- Organisation structure diagram --}}
        <div class="bg-gray-100 p-6 rounded-lg">
            <div class="flex flex-col items-center">
                <div class="bg-primary text-white px-6 py-3 rounded-lg text-center mb-4 w-64">
                    <h3 class="font-bold">Pengerusi</h3>
                    <p class="text-sm">Dato' Ahmad bin Abdullah</p>
                </div>
                <div class="w-0.5 h-6 bg-gray-300"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="bg-primary/90 text-white px-4 py-2 rounded-lg text-center">
                        <h3 class="font-bold text-sm">Timbalan Pengerusi</h3>
                        <p class="text-xs">Puan Siti binti Hassan</p>
                    </div>
                    <div class="bg-primary/90 text-white px-4 py-2 rounded-lg text-center">
                        <h3 class="font-bold text-sm">Setiausaha</h3>
                        <p class="text-xs">Encik Ravi a/l Chandran</p>
                    </div>
                    <div class="bg-primary/90 text-white px-4 py-2 rounded-lg text-center">
                        <h3 class="font-bold text-sm">Bendahari</h3>
                        <p class="text-xs">Puan Lim Mei Ling</p>
                    </div>
                </div>
                <div class="w-0.5 h-6 bg-gray-300"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full max-w-3xl">
                    <div class="bg-primary/80 text-white px-4 py-2 rounded-lg text-center">
                        <h3 class="font-bold text-sm">Jawatankuasa Keahlian</h3>
                        <p class="text-xs">Encik Azman bin Aziz</p>
                    </div>
                    <div class="bg-primary/80 text-white px-4 py-2 rounded-lg text-center">
                        <h3 class="font-bold text-sm">Jawatankuasa Aktiviti</h3>
                        <p class="text-xs">Puan Nurul Huda binti Ismail</p>
                    </div>
                    <div class="bg-primary/80 text-white px-4 py-2 rounded-lg text-center">
                        <h3 class="font-bold text-sm">Jawatankuasa Perhubungan</h3>
                        <p class="text-xs">Encik Chong Kok Wai</p>
                    </div>
                </div>
                <div class="w-0.5 h-6 bg-gray-300"></div>
                <div class="bg-primary/70 text-white px-4 py-2 rounded-lg text-center w-64">
                    <h3 class="font-bold text-sm">Jawatankuasa Negeri</h3>
                    <p class="text-xs">16 Negeri</p>
                </div>
            </div>
        </div>

        {{-- Jawatankuasa Eksekutif --}}
        @php
        $executiveCommittee = [
            ['position' => "Pengerusi", 'name' => "Dato' Ahmad bin Abdullah", 'bio' => "Bekas Pengerusi 4B Malaysia (2010-2015). Mempunyai pengalaman lebih 30 tahun dalam bidang kepimpinan belia.", 'email' => 'ahmad@alumni4b.org.my', 'phone' => '012-345 6789'],
            ['position' => 'Timbalan Pengerusi', 'name' => 'Puan Siti binti Hassan', 'bio' => "Bekas Timbalan Pengerusi 4B Selangor (2012-2018). Aktif dalam program pembangunan wanita dan keluarga.", 'email' => 'siti@alumni4b.org.my', 'phone' => '013-456 7890'],
            ['position' => 'Setiausaha', 'name' => 'Encik Ravi a/l Chandran', 'bio' => "Bekas Setiausaha 4B Perak (2015-2020). Berpengalaman dalam pengurusan organisasi belia di peringkat kebangsaan.", 'email' => 'ravi@alumni4b.org.my', 'phone' => '014-567 8901'],
            ['position' => 'Bendahari', 'name' => 'Puan Lim Mei Ling', 'bio' => "Bekas Bendahari 4B Pulau Pinang (2014-2019). Pakar dalam pengurusan kewangan organisasi bukan kerajaan.", 'email' => 'meiling@alumni4b.org.my', 'phone' => '015-678 9012'],
        ];
        @endphp
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Jawatankuasa Eksekutif</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($executiveCommittee as $member)
                <div class="rounded-lg border bg-white shadow-sm overflow-hidden">
                    <div class="text-center pt-6 pb-2">
                        <div class="mx-auto mb-4 w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs">{{ $member['position'] }}</div>
                        <h3 class="font-semibold text-gray-900">{{ $member['position'] }}</h3>
                        <p class="text-base font-medium text-gray-600">{{ $member['name'] }}</p>
                    </div>
                    <div class="p-4 border-t">
                        <p class="text-sm text-gray-600 mb-4">{{ $member['bio'] }}</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span class="text-gray-600">{{ $member['email'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="text-gray-600">{{ $member['phone'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Jawatankuasa tabs --}}
        @php
        $committees = [
            'Keahlian' => [['position' => 'Pengerusi', 'name' => 'Encik Azman bin Aziz'], ['position' => 'Setiausaha', 'name' => 'Puan Faridah binti Karim'], ['position' => 'Ahli', 'name' => 'Encik Tan Wei Ming'], ['position' => 'Ahli', 'name' => 'Puan Kavitha a/p Subramaniam'], ['position' => 'Ahli', 'name' => 'Encik Mohd Rizal bin Hashim']],
            'Aktiviti' => [['position' => 'Pengerusi', 'name' => 'Puan Nurul Huda binti Ismail'], ['position' => 'Setiausaha', 'name' => 'Encik Jason Wong'], ['position' => 'Ahli', 'name' => 'Puan Aini binti Yusof'], ['position' => 'Ahli', 'name' => 'Encik Muthu a/l Selvan'], ['position' => 'Ahli', 'name' => 'Puan Zarina binti Zakaria']],
            'Perhubungan' => [['position' => 'Pengerusi', 'name' => 'Encik Chong Kok Wai'], ['position' => 'Setiausaha', 'name' => 'Puan Noraini binti Hamzah'], ['position' => 'Ahli', 'name' => 'Encik Saiful bin Bahari'], ['position' => 'Ahli', 'name' => 'Puan Teresa Lim'], ['position' => 'Ahli', 'name' => 'Encik Ganesh a/l Murthy']],
        ];
        @endphp
        <div x-data="{ tab: 'Keahlian' }">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Jawatankuasa</h2>
            <div class="flex gap-2 mb-4 border-b">
                @foreach(array_keys($committees) as $name)
                <button type="button" @click="tab = '{{ $name }}'" :class="tab === '{{ $name }}' ? 'border-b-2 border-primary text-primary font-medium' : 'text-gray-600 hover:text-gray-900'" class="px-4 py-2 text-sm">
                    Jawatankuasa {{ $name }}
                </button>
                @endforeach
            </div>
            @foreach($committees as $name => $members)
            <div x-show="tab === '{{ $name }}'" x-cloak class="rounded-lg border bg-white shadow-sm overflow-hidden">
                <div class="p-6">
                    <h3 class="font-semibold text-gray-900 mb-1">Jawatankuasa {{ $name }}</h3>
                    <p class="text-sm text-gray-500 mb-4">Ahli-ahli jawatankuasa {{ strtolower($name) }} Alumni 4B Malaysia</p>
                    <ul class="space-y-2">
                        @foreach($members as $m)
                        <li class="flex justify-between items-center border-b border-gray-100 pb-2 text-sm">
                            <span class="font-medium text-gray-700">{{ $m['position'] }}</span>
                            <span class="text-gray-600">{{ $m['name'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Jawatankuasa Negeri --}}
        @php
        $stateChapters = [['state' => 'Johor', 'chairman' => "Encik Abdul Rahim bin Ismail"], ['state' => 'Kedah', 'chairman' => 'Puan Norhayati binti Hassan'], ['state' => 'Kelantan', 'chairman' => 'Encik Mohd Fadzli bin Abdullah'], ['state' => 'Melaka', 'chairman' => 'Puan Lim Siew Mei'], ['state' => 'Negeri Sembilan', 'chairman' => 'Encik Suresh a/l Kumar'], ['state' => 'Pahang', 'chairman' => 'Puan Azizah binti Yusof'], ['state' => 'Perak', 'chairman' => 'Encik Chong Wei Liang'], ['state' => 'Perlis', 'chairman' => 'Puan Siti Aminah binti Ali'], ['state' => 'Pulau Pinang', 'chairman' => 'Encik Gopal a/l Krishnan'], ['state' => 'Selangor', 'chairman' => 'Encik Azlan bin Aziz'], ['state' => 'Terengganu', 'chairman' => 'Puan Faridah binti Ismail'], ['state' => 'WP Kuala Lumpur', 'chairman' => 'Encik Tan Chee Keong'], ['state' => 'WP Putrajaya', 'chairman' => 'Encik Mohd Nazri bin Ibrahim']];
        @endphp
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Jawatankuasa Negeri</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($stateChapters as $ch)
                <div class="rounded-lg border bg-gray-50 p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $ch['state'] }}</h3>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="h-4 w-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>{{ $ch['chairman'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-gray-100 p-6 rounded-lg text-center">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Muat Turun Carta Organisasi</h3>
            <p class="text-gray-600 mb-4">Muat turun carta organisasi Alumni 4B Malaysia dalam format PDF.</p>
            <button type="button" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white hover:bg-primary/90 h-10 px-6">Muat Turun PDF</button>
        </div>
    </div>
</div>
@endsection
