<nav aria-label="breadcrumb" class="mb-6">
    <ol class="flex items-center gap-2 text-sm text-primary">
        <li>
            <a href="{{ url('/') }}" class="hover:underline" aria-label="Utama">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </a>
        </li>
        @foreach($items as $item)
        <li class="flex items-center gap-2">
            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @if(isset($item['url']))
            <a href="{{ $item['url'] }}" class="hover:underline">{{ $item['label'] }}</a>
            @else
            <span class="text-gray-600">{{ $item['label'] }}</span>
            @endif
        </li>
        @endforeach
    </ol>
</nav>
