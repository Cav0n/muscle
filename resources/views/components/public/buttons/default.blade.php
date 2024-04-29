<button
    type="{{ $type ?? "button" }}"

    @isset($form) form="{{ $form }}" @endisset

    @class([
        'bg-yellow-600 text-white font-medium shadow border-2 border-yellow-600 rounded-md px-4 py-1',
        'w-full sm:w-auto text-center text-lg md:text-base xl:text-lg',
        'transition-all duration-300',
        'hover:bg-transparent hover:text-yellow-600'
    ])
>
    {{ $label ?? "Valider" }}
</button>
