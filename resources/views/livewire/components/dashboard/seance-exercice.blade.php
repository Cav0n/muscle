<div class="rounded-md bg-neutral-50 border shadow flex flex-col">
    <div class="flex flex-wrap justify-between items-center gap-2 px-4 py-2 select-none cursor-pointer seance-exercice-summary">
        <p class="text-lg font-medium">
            {{ $exercice->name }}
        </p>
        <p wire:ignore class="text-sm text-neutral-500 chevron-container transition-all duration-500">
            <x-heroicon-o-chevron-down class="w-5 h-5"/>
        </p>
    </div>

    <div wire:ignore class="max-h-0 overflow-y-hidden seance-exercice-details">
        <div class="grid md:grid-cols-3 gap-4 px-4 pt-2 pb-4">
            @include('components.public.forms.inputs.default', [
                'id' => 'number_of_reps',
                'label' => 'Nombre de reps',
                'placeholder' => 'Alors combien de répétition ? 🧐',
                'wireModel' => 'number_of_reps'
            ])

            @include('components.public.forms.inputs.default', [
                'id' => 'number_of_series',
                'label' => 'Nombre de séries',
                'placeholder' => 'Combien de fois ?',
                'wireModel' => 'number_of_series'
            ])

            @include('components.public.forms.inputs.default', [
                'id' => 'weight',
                'label' => 'Poids',
                'placeholder' => 'Au moins 100kg j\'espère..',
                'wireModel' => 'weight',
                'suffix' => "kg"
            ])
        </div>
    </div>
</div>

@pushOnce('page.scripts')
    <script type="module">
        $('.seance-exercice-summary').on('click', function () {
            $(this).siblings('.seance-exercice-details')
                .toggleClass('max-h-0 max-h-full')

            $(this).find('.chevron-container').toggleClass('rotate-180')
        });
    </script>
@endpushonce
