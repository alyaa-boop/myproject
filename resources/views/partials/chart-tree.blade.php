@php
    $nodes = $nodes ?? [];
    $level = $level ?? 0;
    $opacity = $level === 0 ? '' : ($level === 1 ? 'bg-primary/90' : 'bg-primary/80');
@endphp
<div class="flex flex-wrap justify-center gap-6 {{ $level > 0 ? 'mt-2' : '' }}">
    @foreach($nodes as $node)
    <div class="flex flex-col items-center">
        <div class="bg-primary {{ $opacity }} text-white px-6 py-3 rounded-lg text-center {{ $level === 0 ? 'w-64 mb-4' : ($level === 1 ? 'w-52 mb-2' : 'w-44') }}">
            @if(!empty($node['image']))
            <div class="mx-auto mb-2 w-12 h-12 rounded-full bg-white/20 overflow-hidden flex items-center justify-center">
                <img src="{{ str_starts_with($node['image'], 'http') ? $node['image'] : asset('storage/' . $node['image']) }}" alt="" class="w-full h-full object-cover">
            </div>
            @endif
            <h3 class="font-bold {{ $level === 0 ? 'text-base' : 'text-sm' }}">{{ $node['position'] ?? 'Jawatan' }}</h3>
            <p class="text-xs mt-0.5">{{ $node['name'] ?? '' }}</p>
        </div>
        @if(!empty($node['children']) && is_array($node['children']))
        <div class="w-0.5 h-4 bg-gray-300"></div>
        @include('partials.chart-tree', ['nodes' => $node['children'], 'level' => $level + 1])
        @endif
    </div>
    @endforeach
</div>
