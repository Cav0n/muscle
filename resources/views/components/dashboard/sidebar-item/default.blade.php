<a href="{{ $url ?? "#" }}" class="flex items-center gap-2 text-xl md:text-lg xl:text-xl bg-neutral-200 px-4 xl:px-6 py-2 xl:py-3 rounded-lg">
    @isset($icon)
        @if (isset($current) && $current)
            @svg("heroicon-s-$icon", 'w-6 h-6')
        @else
            @svg("heroicon-o-$icon", 'w-6 h-6')
        @endif
    @endisset
    <span class="truncate">
        {{ $label ?? "Lien" }}
    </span>
</a>
