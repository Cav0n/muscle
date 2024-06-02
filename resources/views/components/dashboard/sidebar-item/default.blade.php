<a href="{{ $url ?? "#" }}" @class([
    "flex items-center gap-2 text-xl border-2 border-transparent md:text-lg xl:text-xl bg-neutral-200 dark:bg-neutral-800 px-4 xl:px-6 py-2 xl:py-3 rounded-lg select-none",
    "transition-all duration-300 hover:border-yellow-600",
    "border-yellow-600 text-yellow-600" => isset($current) && $current
])>
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

    @if(isset($number) && $number > 0)
        <span class="flex-shrink-0 ml-auto bg-neutral-100 rounded-md h-full px-3 py-1 text-sm">
            {{ $number }}
        </span>
    @endif
</a>
