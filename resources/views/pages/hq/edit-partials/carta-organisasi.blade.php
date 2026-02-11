@php $c = $content ?? []; @endphp
<div class="border border-gray-200 rounded-lg p-6 space-y-6 bg-white">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tajuk</label>
        <input type="text" data-edit-key="title" value="{{ $c['title'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
        <textarea data-edit-key="subtitle" rows="2" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $c['subtitle'] ?? '' }}</textarea>
    </div>
    <h3 class="font-semibold">Carta Organisasi - Jawatan Utama</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block text-sm text-gray-600 mb-1">Pengerusi</label>
            <input type="text" data-edit-key="pengerusi" value="{{ $c['pengerusi'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">Timbalan Pengerusi</label>
            <input type="text" data-edit-key="tp" value="{{ $c['tp'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">Setiausaha</label>
            <input type="text" data-edit-key="setiausaha" value="{{ $c['setiausaha'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">Bendahari</label>
            <input type="text" data-edit-key="bendahari" value="{{ $c['bendahari'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">JK Keahlian</label>
            <input type="text" data-edit-key="jk_keahlian" value="{{ $c['jk_keahlian'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">JK Aktiviti</label>
            <input type="text" data-edit-key="jk_aktiviti" value="{{ $c['jk_aktiviti'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
        <div><label class="block text-sm text-gray-600 mb-1">JK Perhubungan</label>
            <input type="text" data-edit-key="jk_perhubungan" value="{{ $c['jk_perhubungan'] ?? '' }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></div>
    </div>
    <h3 class="font-semibold">Jawatankuasa Eksekutif</h3>
    <div data-edit-array="executive" class="space-y-4">
        @foreach(($c['executive'] ?? []) as $ex)
        <div data-edit-item class="p-4 border rounded-lg space-y-2">
            <input type="text" data-edit-field="position" value="{{ $ex['position'] ?? '' }}" placeholder="Jawatan" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            <input type="text" data-edit-field="name" value="{{ $ex['name'] ?? '' }}" placeholder="Nama" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            <textarea data-edit-field="bio" rows="2" placeholder="Biografi" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ $ex['bio'] ?? '' }}</textarea>
            <div class="grid grid-cols-2 gap-2">
                <input type="text" data-edit-field="email" value="{{ $ex['email'] ?? '' }}" placeholder="E-mel" class="rounded-md border border-gray-300 px-3 py-2 text-sm">
                <input type="text" data-edit-field="phone" value="{{ $ex['phone'] ?? '' }}" placeholder="Telefon" class="rounded-md border border-gray-300 px-3 py-2 text-sm">
            </div>
        </div>
        @endforeach
    </div>
    <h3 class="font-semibold">Jawatankuasa Negeri</h3>
    <div data-edit-array="state_chapters" class="space-y-4">
        @foreach(($c['state_chapters'] ?? []) as $sc)
        <div data-edit-item class="flex gap-2 items-center">
            <input type="text" data-edit-field="state" value="{{ $sc['state'] ?? '' }}" placeholder="Negeri" class="flex-1 rounded-md border border-gray-300 px-3 py-2 text-sm">
            <input type="text" data-edit-field="chairman" value="{{ $sc['chairman'] ?? '' }}" placeholder="Pengerusi" class="flex-1 rounded-md border border-gray-300 px-3 py-2 text-sm">
        </div>
        @endforeach
    </div>
</div>
