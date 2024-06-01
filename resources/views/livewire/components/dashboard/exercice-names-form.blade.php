<div class="flex flex-col gap-4">

    <p class="text-lg md:text-xl font-medium">Noms alternatifs</p>

    <div class="flex flex-wrap gap-2">
        <div>
            <input id="lang_en" name="lang" type="radio" value="en" wire:model.live="lang" class="sr-only peer">
            <label for="lang_en" class="px-4 py-1 bg-neutral-50 text-neutral-800 rounded peer-checked:bg-yellow-500 peer-checked:text-white cursor-pointer">
                EN
            </label>
        </div>
        <div>
            <input id="lang_fr" name="lang" type="radio" value="fr" wire:model.live="lang" class="sr-only peer">
            <label for="lang_fr" class="px-4 py-1 bg-neutral-50 text-neutral-800 rounded peer-checked:bg-yellow-500 peer-checked:text-white cursor-pointer">
                FR
            </label>
        </div>
    </div>

    <div class="flex flex-col gap-2">
        <div @class([
            'hidden' => $lang != 'en',
            'flex flex-col gap-2' => $lang == 'en'
        ])>
            <div class="flex gap-2 flex-wrap">
                @foreach(($exercice->other_names['en']??[]) as $index => $otherName)
                    <div class="px-3 py-1 rounded bg-neutral-100 text-neutral-500 flex items-center whitespace-nowrap gap-1">
                        <span class="text-sm truncate">{{ $otherName }}</span>
                        <button type="button" wire:click='deleteOtherName({{ $index }})'>
                            <x-heroicon-o-x-circle class="w-4 h-4" />
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center gap-2">
                @include('components.public.forms.inputs.default', [
                    'id' => 'name_en',
                    'label' => 'Nom en anglais',
                    'wireModel' => 'newExerciceName'
                ])

                <button type="button" wire:click='save'>
                    <x-heroicon-o-x-circle class="w-4 h-4" />
                </button>
            </div>

        </div>

        <div @class([
            'hidden' => $lang != 'fr',
            'flex flex-col gap-2' => $lang == 'fr'
        ])>
            <div class="flex gap-2 flex-wrap">
                @foreach(($exercice->other_names['fr']??[]) as $index => $otherName)
                    <div class="px-3 py-1 rounded bg-neutral-100 text-neutral-500 flex items-center whitespace-nowrap gap-1">
                        <span class="text-sm truncate">{{ $otherName }}</span>
                        <button type="button" wire:click='deleteOtherName({{ $index }})'>
                            <x-heroicon-o-x-circle class="w-4 h-4" />
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="flex items-end gap-2">
                @include('components.public.forms.inputs.default', [
                    'id' => 'name_fr',
                    'label' => 'Nom en français',
                    'wireModel' => 'newExerciceName',
                    'wireEnter' => 'save'
                ])

                <button type="button" wire:click='save' class="flex-shrink-0 items-center px-4 py-3 bg-yellow-500 text-white rounded-lg">
                    <x-heroicon-m-check class="w-4 h-4" />
                </button>
            </div>
        </div>
    </div>
</div>
