@php
    $c = $content ?? [];
    $chartTree = $c['chart_tree'] ?? null;
    if (empty($chartTree) || !is_array($chartTree)) {
        $chartTree = [];
    }
    $chartTreeJson = json_encode($chartTree);
    $executive = $c['executive'] ?? \App\Models\PageContent::defaultContent('carta-organisasi')['executive'] ?? [];
    $executive = array_slice($executive, 0, 4);
    while (count($executive) < 4) { $executive[] = ['position' => '', 'name' => '', 'bio' => '', 'email' => '', 'phone' => '']; }
    $stateChapters = $c['state_chapters'] ?? \App\Models\PageContent::defaultContent('carta-organisasi')['state_chapters'] ?? [];
@endphp
{{-- Carta organisasi: editor pokok dengan tambah/padam/cabang, drag-drop, upload gambar --}}
<div class="container mx-auto px-4 md:px-6 py-8 rounded-lg border border-gray-200 bg-white">
    <div class="space-y-8">
        <div class="text-center">
            <label class="block text-xs font-medium text-gray-500 mb-1">Tajuk</label>
            <input type="text" data-edit-key="title" value="{{ $c['title'] ?? 'Carta Organisasi Alumni 4B Malaysia' }}"
                class="w-full text-center text-3xl font-bold text-gray-900 rounded-md border border-gray-200 px-3 py-2 max-w-2xl mx-auto block focus:border-primary">
            <label class="block text-xs font-medium text-gray-500 mt-4 mb-1">Keterangan</label>
            <textarea data-edit-key="subtitle" rows="2" class="w-full text-center text-gray-600 rounded-md border border-gray-200 px-3 py-2 max-w-2xl mx-auto block focus:border-primary">{{ $c['subtitle'] ?? 'Struktur organisasi Alumni 4B Malaysia yang menguruskan aktiviti dan program di peringkat kebangsaan dan negeri.' }}</textarea>
        </div>

        {{-- Tree diagram editor (Alpine + Sortable) --}}
        <div id="chart-tree-editor" class="bg-gray-100 p-6 rounded-lg" x-data="chartTreeEditor(@js($chartTree))"
            x-init="
                initSortables();
                const syncToInput = () => {
                    const el = document.getElementById('chart-tree-input');
                    if (el) {
                        const strip = n => { if (!n) return n; return (Array.isArray(n) ? n : [n]).map(x => { const c = Object.assign({}, x); delete c.preview; if (c.children?.length) c.children = strip(c.children); return c; }); };
                        el.value = JSON.stringify(strip(chartTree));
                    }
                };
                $watch('chartTree', syncToInput);
                $nextTick(() => syncToInput());
                document.addEventListener('hq:sync-chart-tree', syncToInput);
            ">
            <input type="hidden" id="chart-tree-input">
            <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                <span class="text-sm text-gray-600">Seret ikon ⋮⋮ untuk susun. Klik bulatan foto sahaja untuk upload gambar.</span>
                <button type="button" @click="addRoot()" class="text-sm font-medium text-primary hover:underline shrink-0">+ Tambah punca</button>
            </div>

            <div class="flex flex-col items-center w-full overflow-x-auto">
                {{-- Level 0: roots --}}
                <div class="chart-children flex flex-wrap justify-center gap-4 sm:gap-6 mb-4" data-level="0">
                    <template x-for="(root, ri) in chartTree" :key="root.id">
                        <div class="chart-node flex flex-col items-center flex-shrink-0" :data-id="root.id">
                            <div class="chart-card flex flex-col items-center bg-primary text-white px-3 py-3 sm:px-5 sm:py-4 rounded-xl w-[clamp(7rem,20vmin,14rem)] min-w-[7rem] relative shadow-md" data-level="0">
                                <span class="chart-drag-handle cursor-grab active:cursor-grabbing absolute left-2 top-2 text-white/80 text-sm leading-none select-none" title="Seret untuk susun">⋮⋮</span>
                                <div class="relative w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-white/20 flex items-center justify-center mb-1 sm:mb-2 overflow-hidden shrink-0">
                                    <template x-if="root.preview || root.image">
                                        <img :src="(root.preview || (root.image && (root.image.startsWith('http') ? root.image : '/storage/' + root.image)))" class="w-full h-full object-cover" alt="">
                                    </template>
                                    <template x-if="!root.preview && !root.image">
                                        <span class="text-white/70 text-xs">Klik untuk foto</span>
                                    </template>
                                    <input type="file" accept="image/*" name="chart_image[]" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer chart-file rounded-full" @change="onFile($event, root)">
                                </div>
                                <input type="text" x-model="root.position" placeholder="Jawatan" class="w-full bg-transparent border-b border-white/50 text-center text-white font-bold text-xs sm:text-sm py-0.5 truncate">
                                <input type="text" x-model="root.name" placeholder="Nama" class="w-full bg-transparent border-b border-white/40 text-center text-white text-[10px] sm:text-xs mt-1 py-0.5 truncate">
                                <div class="flex gap-1 sm:gap-2 mt-2 sm:mt-3 flex-shrink-0 flex-wrap justify-center">
                                    <button type="button" @click.stop="addChild(root)" class="text-[10px] sm:text-xs bg-white/25 hover:bg-white/35 px-1.5 py-1 sm:px-2.5 sm:py-1.5 rounded border border-white/30 text-white pointer-events-auto whitespace-nowrap">Tambah Anak</button>
                                    <button type="button" @click.stop="removeNode(chartTree, ri)" class="text-[10px] sm:text-xs bg-red-500/80 hover:bg-red-600 px-1.5 py-1 sm:px-2.5 sm:py-1.5 rounded text-white pointer-events-auto whitespace-nowrap">Padam</button>
                                </div>
                            </div>
                            {{-- Level 1: root's children --}}
                            <div class="w-0.5 h-4 bg-gray-300" x-show="root.children && root.children.length"></div>
                            <div class="chart-children flex flex-wrap justify-center gap-3 sm:gap-4 my-2" :data-parent-id="root.id" x-show="root.children && root.children.length">
                                <template x-for="(child, ci) in root.children" :key="child.id">
                                    <div class="chart-node flex flex-col items-center flex-shrink-0" :data-id="child.id">
                                        <div class="chart-card flex flex-col items-center bg-[#3d4a9e] text-white px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl w-[clamp(6rem,16vmin,12rem)] min-w-[6rem] relative shadow" data-level="1">
                                            <span class="chart-drag-handle cursor-grab active:cursor-grabbing absolute left-1.5 top-1.5 text-white/80 text-xs leading-none select-none">⋮⋮</span>
                                            <div class="relative w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/20 flex items-center justify-center overflow-hidden shrink-0">
                                                <template x-if="child.preview || child.image">
                                                    <img :src="(child.preview || (child.image && (child.image.startsWith('http') ? child.image : '/storage/' + child.image)))" class="w-full h-full object-cover" alt="">
                                                </template>
                                                <template x-if="!child.preview && !child.image">
                                                    <span class="text-white/60 text-[10px]">Foto</span>
                                                </template>
                                                <input type="file" accept="image/*" name="chart_image[]" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer chart-file rounded-full" @change="onFile($event, child)">
                                            </div>
                                            <input type="text" x-model="child.position" placeholder="Jawatan" class="w-full bg-transparent border-b border-white/50 text-center text-white font-bold text-[10px] sm:text-xs py-0.5 truncate">
                                            <input type="text" x-model="child.name" placeholder="Nama" class="w-full bg-transparent border-b border-white/40 text-center text-white text-[10px] mt-0.5 py-0.5 truncate">
                                            <div class="flex gap-1 sm:gap-1.5 mt-1.5 sm:mt-2 flex-shrink-0 flex-wrap justify-center">
                                                <button type="button" @click.stop="addChild(child)" class="text-[9px] sm:text-xs bg-white/25 hover:bg-white/35 px-1 py-0.5 sm:px-2 sm:py-1 rounded border border-white/30 text-white pointer-events-auto whitespace-nowrap">Tambah Anak</button>
                                                <button type="button" @click.stop="removeNode(root.children, ci)" class="text-[9px] sm:text-xs bg-red-500/80 hover:bg-red-600 px-1 py-0.5 sm:px-2 sm:py-1 rounded text-white pointer-events-auto whitespace-nowrap">Padam</button>
                                            </div>
                                        </div>
                                        {{-- Level 2: child's children --}}
                                        <div class="w-0.5 h-3 bg-gray-300" x-show="child.children && child.children.length"></div>
                                        <div class="chart-children flex flex-wrap justify-center gap-2 sm:gap-3 mt-2" :data-parent-id="child.id" x-show="child.children && child.children.length">
                                            <template x-for="(grand, gi) in child.children" :key="grand.id">
                                                <div class="chart-node flex flex-col items-center flex-shrink-0" :data-id="grand.id">
                                                    <div class="chart-card flex flex-col items-center bg-[#5a65b8] text-white px-2 py-2 sm:px-3 sm:py-2.5 rounded-xl w-[clamp(5rem,14vmin,10rem)] min-w-[5rem] relative shadow" data-level="2">
                                                        <span class="chart-drag-handle cursor-grab active:cursor-grabbing absolute left-1 top-1 text-white/80 text-xs leading-none select-none">⋮⋮</span>
                                                        <div class="relative w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/20 flex items-center justify-center overflow-hidden shrink-0">
                                                            <template x-if="grand.preview || grand.image">
                                                                <img :src="(grand.preview || (grand.image && (grand.image.startsWith('http') ? grand.image : '/storage/' + grand.image)))" class="w-full h-full object-cover" alt="">
                                                            </template>
                                                            <template x-if="!grand.preview && !grand.image">
                                                                <span class="text-white/60 text-[10px]">Foto</span>
                                                            </template>
                                                            <input type="file" accept="image/*" name="chart_image[]" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer chart-file rounded-full" @change="onFile($event, grand)">
                                                        </div>
                                                        <input type="text" x-model="grand.position" placeholder="Jawatan" class="w-full bg-transparent border-b border-white/50 text-center text-white font-bold text-[10px] py-0.5 truncate">
                                                        <input type="text" x-model="grand.name" placeholder="Nama" class="w-full bg-transparent border-b border-white/40 text-center text-white text-[9px] sm:text-[10px] mt-0.5 py-0.5 truncate">
                                                        <div class="flex gap-1 sm:gap-1.5 mt-1.5 sm:mt-2 flex-shrink-0 flex-wrap justify-center">
                                                            <button type="button" @click.stop="addChild(grand)" class="text-[9px] sm:text-[10px] bg-white/25 hover:bg-white/35 px-1 py-0.5 sm:px-2 sm:py-1 rounded border border-white/30 text-white pointer-events-auto whitespace-nowrap">Tambah Anak</button>
                                                            <button type="button" @click.stop="removeNode(child.children, gi)" class="text-[9px] sm:text-[10px] bg-red-500/80 hover:bg-red-600 px-1 py-0.5 sm:px-2 sm:py-1 rounded text-white pointer-events-auto whitespace-nowrap">Padam</button>
                                                        </div>
                                                    </div>
                                                    {{-- Level 3: grand's children --}}
                                                    <div class="w-0.5 h-3 bg-gray-300" x-show="grand.children && grand.children.length"></div>
                                                    <div class="chart-children flex flex-wrap justify-center gap-1.5 sm:gap-2 mt-2" :data-parent-id="grand.id" x-show="grand.children && grand.children.length">
                                                        <template x-for="(great, ggi) in grand.children" :key="great.id">
                                                            <div class="chart-node flex flex-col items-center flex-shrink-0" :data-id="great.id">
                                                                <div class="chart-card flex flex-col items-center bg-[#7d87c9] text-white px-2 py-1.5 sm:px-2.5 sm:py-2 rounded-xl w-[clamp(4rem,12vmin,9rem)] min-w-[4rem] relative shadow" data-level="3">
                                                                    <span class="chart-drag-handle cursor-grab active:cursor-grabbing absolute left-0.5 top-0.5 text-white/80 text-[10px] leading-none select-none">⋮⋮</span>
                                                                    <div class="relative w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-white/20 flex items-center justify-center overflow-hidden shrink-0">
                                                                        <template x-if="great.preview || great.image">
                                                                            <img :src="(great.preview || (great.image && (great.image.startsWith('http') ? great.image : '/storage/' + great.image)))" class="w-full h-full object-cover" alt="">
                                                                        </template>
                                                                        <template x-if="!great.preview && !great.image">
                                                                            <span class="text-white/60 text-[9px]">Foto</span>
                                                                        </template>
                                                                        <input type="file" accept="image/*" name="chart_image[]" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer chart-file rounded-full" @change="onFile($event, great)">
                                                                    </div>
                                                                    <input type="text" x-model="great.position" placeholder="Jawatan" class="w-full bg-transparent border-b border-white/50 text-center text-white font-bold text-[10px] py-0.5 truncate">
                                                                    <input type="text" x-model="great.name" placeholder="Nama" class="w-full bg-transparent border-b border-white/40 text-center text-white text-[10px] mt-0.5 py-0.5 truncate">
                                                                    <button type="button" @click.stop="removeNode(grand.children, ggi)" class="text-[9px] sm:text-[10px] bg-red-500/80 hover:bg-red-600 text-white px-1 py-0.5 sm:px-2 sm:py-1 rounded mt-1 pointer-events-auto whitespace-nowrap">Padam</button>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Jawatankuasa Eksekutif (dengan upload foto) --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Jawatankuasa Eksekutif</h2>
            <div data-edit-array="executive" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($executive as $member)
                <div data-edit-item class="rounded-lg border bg-white shadow-sm overflow-hidden">
                    <div class="text-center pt-6 pb-2 relative">
                        <div class="mx-auto mb-4 w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs overflow-hidden executive-photo">
                            @if(!empty($member['image']))
                            <img src="{{ str_starts_with($member['image'] ?? '', 'http') ? $member['image'] : asset('storage/' . $member['image']) }}" alt="" class="w-full h-full object-cover">
                            @else
                            Foto
                            @endif
                        </div>
                        <input type="file" accept="image/*" name="executive_image_{{ $loop->index }}" class="absolute top-4 left-1/2 -translate-x-1/2 w-32 h-32 rounded-full opacity-0 cursor-pointer executive-file" @change="executiveFilePreview(this)">
                        <input type="hidden" data-edit-field="image" value="{{ $member['image'] ?? '' }}">
                        <input type="text" data-edit-field="position" value="{{ $member['position'] ?? '' }}" placeholder="Jawatan" class="block w-full text-center font-semibold text-gray-900 border-0 border-b border-transparent focus:border-primary rounded-none py-0">
                        <input type="text" data-edit-field="name" value="{{ $member['name'] ?? '' }}" placeholder="Nama" class="block w-full text-center text-base font-medium text-gray-600 border-0 border-b border-transparent focus:border-primary rounded-none py-0 mt-1">
                    </div>
                    <div class="p-4 border-t space-y-2">
                        <textarea data-edit-field="bio" rows="2" placeholder="Biografi" class="w-full text-sm text-gray-600 rounded border border-gray-200 px-2 py-1 focus:border-primary">{{ $member['bio'] ?? '' }}</textarea>
                        <input type="text" data-edit-field="email" value="{{ $member['email'] ?? '' }}" placeholder="E-mel" class="w-full text-sm rounded border border-gray-200 px-2 py-1 focus:border-primary">
                        <input type="text" data-edit-field="phone" value="{{ $member['phone'] ?? '' }}" placeholder="Telefon" class="w-full text-sm rounded border border-gray-200 px-2 py-1 focus:border-primary">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Jawatankuasa Negeri --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Jawatankuasa Negeri</h2>
            <div data-edit-array="state_chapters" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($stateChapters as $ch)
                <div data-edit-item class="rounded-lg border bg-gray-50 p-4">
                    <input type="text" data-edit-field="state" value="{{ $ch['state'] ?? '' }}" placeholder="Negeri" class="block w-full text-lg font-semibold text-gray-900 border-0 border-b border-transparent focus:border-primary rounded-none px-0 py-0 mb-2">
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <input type="text" data-edit-field="chairman" value="{{ $ch['chairman'] ?? '' }}" placeholder="Pengerusi" class="flex-1 text-sm text-gray-600 border-0 border-b border-transparent focus:border-primary rounded-none px-0 py-0">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-gray-100 p-6 rounded-lg text-center">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Muat Turun Carta Organisasi</h3>
            <p class="text-gray-600 mb-4">Muat turun carta organisasi dalam format PDF.</p>
            <span class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-white h-10 px-6">Muat Turun PDF</span>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('alpine:init', function() {
    Alpine.data('chartTreeEditor', function(initialTree) {
        return {
            chartTree: Array.isArray(initialTree) ? JSON.parse(JSON.stringify(initialTree)) : [],
            newId() {
                return 'n' + Date.now() + '_' + Math.random().toString(36).slice(2, 9);
            },
            addRoot() {
                this.chartTree = this.chartTree || [];
                this.chartTree.push({ id: this.newId(), position: 'Jawatan baru', name: '', image: null, children: [] });
            },
            addChild(node) {
                node.children = node.children || [];
                node.children.push({ id: this.newId(), position: '', name: '', image: null, children: [] });
            },
            removeNode(arr, index) {
                if (!arr || !Array.isArray(arr)) return;
                arr.splice(index, 1);
            },
            onFile(event, node) {
                const file = event.target.files && event.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    node.preview = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            initSortables() {
                this.$nextTick(() => {
                    const self = this;
                    document.querySelectorAll('.chart-children').forEach(container => {
                        if (container._sortable) return;
                        const parentId = container.getAttribute('data-parent-id');
                        const level = container.getAttribute('data-level');
                        const isRoot = level === '0';
                        container._sortable = new Sortable(container, {
                            animation: 150,
                            handle: '.chart-drag-handle',
                            draggable: '.chart-node',
                            ghostClass: 'opacity-50',
                            onEnd() {
                                const parent = parentId ? self.findNode(self.chartTree, parentId) : null;
                                const arr = parent ? (parent.children || []) : self.chartTree;
                                if (!Array.isArray(arr)) return;
                                const order = Array.from(container.children).map(function(el) { return el.getAttribute('data-id'); }).filter(Boolean);
                                const byId = {};
                                arr.forEach(function(n) { byId[n.id] = n; });
                                const newArr = order.map(function(id) { return byId[id]; }).filter(Boolean);
                                if (parent) parent.children = newArr; else self.chartTree = newArr;
                            }
                        });
                    });
                });
            },
            findNode(nodes, id) {
                if (!nodes) return null;
                const arr = Array.isArray(nodes) ? nodes : [nodes];
                for (const n of arr) {
                    if (n.id === id) return n;
                    const found = this.findNode(n.children, id);
                    if (found) return found;
                }
                return null;
            }
        };
    });
});
function executiveFilePreview(input) {
    const file = input.files && input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function() {
        const wrap = input.closest('[data-edit-item]');
        const imgWrap = wrap.querySelector('.executive-photo');
        if (imgWrap) imgWrap.innerHTML = '<img src="' + reader.result + '" class="w-full h-full object-cover" alt="">';
    };
    reader.readAsDataURL(file);
}
</script>
@endpush
