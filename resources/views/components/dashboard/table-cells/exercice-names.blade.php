<div class="flex flex-col gap-1 max-w-80 overflow-hidden">
    <span class="flex items-center gap-1">
        @if (Auth::user()->exercice_favorites->contains($row->id))
            <x-heroicon-m-star class="w-4 h-4 text-yellow-400" />
        @endif
        <span class="truncate">
            {{ $row->name }}
        </span>
    </span>

    @if (isset($row->other_names['fr']))
    <div class="flex flex-wrap gap-2 items-center">
        @foreach ($row->other_names['fr'] as $otherName)
            <span class="text-xs px-2 py-[3px] rounded bg-neutral-100 text-neutral-500">{{ $otherName }}</span>
        @endforeach
    </div>
    @endif

    @if (isset($row->other_names['en']))
    <div class="flex flex-wrap gap-2 items-center">
        @foreach ($row->other_names['en'] as $otherName)
            <span class="text-xs px-2 py-[3px] rounded bg-neutral-100 text-neutral-500">{{ $otherName }}</span>
        @endforeach
    </div>
    @endif
</div>
