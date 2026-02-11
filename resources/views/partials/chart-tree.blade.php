@php
    $nodes = $nodes ?? [];
    $level = $level ?? 0;
    $levelColors = ['bg-primary', 'bg-[#3d4a9e]', 'bg-[#5a65b8]', 'bg-[#7d87c9]'];
    $levelBg = $levelColors[min($level, count($levelColors) - 1)];
    $levelSizes = [
        'w-[clamp(7rem,20vmin,14rem)] min-w-[7rem] px-3 py-2 sm:px-6 sm:py-3 mb-4',
        'w-[clamp(6rem,16vmin,12rem)] min-w-[6rem] px-2 py-2 sm:px-4 sm:py-2 mb-2',
        'w-[clamp(5rem,14vmin,10rem)] min-w-[5rem] px-2 py-1.5 sm:px-3 sm:py-2 mb-2',
        'w-[clamp(4rem,12vmin,9rem)] min-w-[4rem] px-2 py-1 sm:px-2 sm:py-1.5 mb-2',
    ];
    $sizeClass = $levelSizes[min($level, count($levelSizes) - 1)];
@endphp
<div class="flex flex-wrap justify-center gap-4 sm:gap-6 {{ $level > 0 ? 'mt-2' : '' }}">
    @foreach($nodes as $node)
    <div class="flex flex-col items-center flex-shrink-0">
        <div class="{{ $levelBg }} {{ $sizeClass }} text-white rounded-lg text-center">
            @if(!empty($node['image']))
            <div class="mx-auto mb-1 sm:mb-2 w-8 h-8 sm:w-12 sm:h-12 rounded-full bg-white/30 overflow-hidden flex items-center justify-center">
                <img src="{{ str_starts_with($node['image'], 'http') ? $node['image'] : asset('storage/' . $node['image']) }}" alt="" class="w-full h-full object-cover">
            </div>
            @endif
            <h3 class="font-bold text-white {{ $level === 0 ? 'text-xs sm:text-base' : 'text-[10px] sm:text-sm' }} truncate">{{ $node['position'] ?? 'Jawatan' }}</h3>
            <p class="text-white/90 text-[10px] sm:text-xs mt-0.5 truncate">{{ $node['name'] ?? '' }}</p>
        </div>
        @if(!empty($node['children']) && is_array($node['children']))
        <div class="w-0.5 h-4 bg-gray-300"></div>
        @include('partials.chart-tree', ['nodes' => $node['children'], 'level' => $level + 1])
        @endif
    </div>
    @endforeach
</div>
