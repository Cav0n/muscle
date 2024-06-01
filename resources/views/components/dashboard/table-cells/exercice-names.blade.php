<div class="flex flex-col gap-1 max-w-80 overflow-hidden">
    <span class="truncate">{{ $row->name }}</span>

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
