<div class="flex flex-col gap-4">
    @if (!isset($selectedExercice))
        @include('components.public.forms.inputs.default', [
            'id' => "exercice-search",
            'label' => "Exercice",
            "wireModel" => "search",
            'required' => true
        ])

        <div class="flex flex-col gap-2">
            @forelse (($exercices ?? []) as $exercice)
                <button type="button" wire:click='selectExercice({{ $exercice->id }})' class="flex items-center flex-wrap gap-1 px-4 py-2 font-medium bg-neutral-50 rounded-lg border shadow">
                    {{-- <img src="{{ $exercice->images->first()->url }}" alt="Image de l'exercice" class="w-20 aspect-video rounded-md object-cover flex-shrink-0"> --}}
                    @if (Auth::user()->exercice_favorites->contains($exercice->id))
                        <x-heroicon-m-star class="w-4 h-4 text-yellow-400" />
                    @endif
                    <span class="truncate">{{ $exercice->name }}</span>
                </button>
            @empty
                <p class="text-neutral-500">Aucun exercice trouvé.</p>
            @endforelse
        </div>
    @else
        <div class="px-4 py-1 bg-neutral-100 text-neutral-600 rounded-lg flex items-center gap-2 w-fit select-none">
            <p class="truncate">{{ $selectedExercice->name }}</p>
            <button type="button" wire:click='unselectExercice()'>
                <x-heroicon-o-x-mark class="w-4 h-4"/>
            </button>
        </div>
        <input type="hidden" name="{{ $name ?? "exercice_id" }}" value="{{ $selectedExercice?->id ?? null }}">
    @endif
</div>
