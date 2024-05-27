<a
    href="{{ $url ?? "#" }}"

    @class([
        'font-medium shadow border-2 rounded-md px-4 py-1',
        'w-full sm:w-auto text-center text-lg md:text-base xl:text-lg',
        'text-lg' => isset($size) && $size == "big",
        'transition-all duration-300',
        'hover:bg-transparent hover:text-yellow-600 border-yellow-600 bg-yellow-600 text-white' => !isset($color) || $color == "yellow",
        'hover:bg-transparent hover:text-red-600 border-red-600 bg-red-600 text-white' => isset($color) && $color == "red",
    ])
>
    {{ $label ?? "Valider" }}
</a>
