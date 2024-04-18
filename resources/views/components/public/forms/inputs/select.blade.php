<div class="flex flex-col gap-1">
    @isset($label)
        <label for="{{ $id ?? $name }}" class="select-none">
            {{ $label }}
        </label>
    @endisset

    <select name="{{ $name ?? $id }}" id="{{ $id ?? $name }}"
        @isset($placeholder) placeholder="{{ $placeholder }}
        @if (isset($required) && $required) * @endif" @endisset

        @disabled(isset($disabled) && $disabled)
        @required(isset($required) && $required)

        @isset($wireModel) wire:model.live='{{$wireModel}}' @endisset

        @class([
            "w-full px-4 py-2 rounded border border-neutral-300 bg-white dark:bg-neutral-800 dark:border-neutral-600 dark:text-white focus-within:border-yellow-600 focus-within:shadow-inner !outline-none transition-all duration-300 !ring-0 select-none",
            'disabled:bg-neutral-200 disabled:text-neutral-600 disabled:cursor-not-allowed disabled:select-none',
            'placeholder:text-gray-400' => !$errors->has($name ?? $id),
            'border-red-600 bg-red-100 text-red-600 placeholder:text-red-600' => $errors->has($name ?? $id),
            $inputClass ?? "" => isset($inputClass),
        ])>
        @foreach (($options ?? []) as $option => $label)
            <option value="{{ $label['id'] ?? $option }}" @selected(isset($value) && $value == ($label['id'] ?? $option))>
                {{ $label['name'] ?? $label ?? $option }}
            </option>
        @endforeach
    </select>

    @error($name ?? $id)
        <div class="text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>
