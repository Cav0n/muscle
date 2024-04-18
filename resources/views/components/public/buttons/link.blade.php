<a
    href="{{ $url ?? "#" }}"

    @class([
        'bg-yellow-600 text-white font-medium shadow border-2 border-yellow-600 rounded px-4 py-1',
        'text-lg' => isset($size) && $size == "big",
        'transition-all duration-300',
        'hover:bg-transparent hover:text-yellow-600'
    ])
>
    {{ $label ?? "Valider" }}
</a>
