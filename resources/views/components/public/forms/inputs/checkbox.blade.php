<div class="flex flex-col gap-1">
    <div class="relative w-full flex gap-2 items-center" wire:loading.class='animate-pulse'>
        <input type="checkbox" name="{{ $name ?? $id }}" id="{{ $id ?? $name }}" @checked($checked ?? false) value="1"
            @required(isset($required) && $required)
            @isset($wireModel) wire:model.live='{{$wireModel}}' @endisset

            class="!accent-yellow-600 !text-yellow-600 appearance-none rounded">

        @isset($label)
            <label for="{{ $id ?? $name }}" class="select-none">
                {{ $label }}
            </label>
        @endisset
    </div>

    @error($name ?? $id)
        <div class="text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>
