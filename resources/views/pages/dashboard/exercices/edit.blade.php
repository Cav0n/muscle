@extends('layouts.dashboard')

@section('page.title', $exercice->name)

@section('page.buttons')
    @include('components.public.buttons.default', [
        'label' => 'Sauvegarder',
        'type' => 'submit',
        'form' => 'exercice-form'
    ])
@endsection

@section('page.content')
<form id="exercice-form" class="grid md:grid-cols-3 gap-4 md:gap-8" method="POST" action="{{ route('dashboard.exercices.update', ['exercice' => $exercice]) }}">
    @csrf

    {{-- Left side --}}
    <div class="md:col-span-2 flex flex-col gap-4 md:gap-8">
        <x-dashboard.container.default :title='"Informations"'>
            @include('components.public.forms.inputs.default', [
                'id' => 'name',
                'label' => "Nom",
                'placeholder' => "Nom de l'exercice",
                'value' => $exercice->name
            ])
        </x-dashboard.container.default>

        <x-dashboard.container.default :title='"Instructions"'>
            @foreach (($exercice->instructions ?? []) as $instruction)
                <p>
                    {{ $instruction }}
                </p>
            @endforeach
        </x-dashboard.container.default>
    </div>

    {{-- Right side --}}
    <div class="flex flex-col gap-4 md:gap-8">
        <x-dashboard.container.default>
            @include('components.public.forms.inputs.select', [
                "id" => "category",
                "label" => "Catégorie",
                "options" => \App\Models\Exercice::categories_available(),
                "value" => $exercice->category
            ])

            @include('components.public.forms.inputs.select', [
                "id" => "level",
                "label" => "Niveau",
                "value" => $exercice->level,
                "options" => [
                    'beginner' => 'beginner', 'intermediate' => 'intermediate', 'expert' => 'expert'
                ],
            ])

            @include('components.public.forms.inputs.select', [
                "id" => "force",
                "label" => "Type",
                "value" => $exercice->force,
                "options" => [
                    'pull' => 'pull', 'push' => 'push', 'expert' => 'expert'
                ],
            ])

            @include('components.public.forms.inputs.default', [
                "id" => "equipment",
                "label" => "Équipement",
                "value" => $exercice->equipment,
            ])
        </x-dashboard.container.default>

        <x-dashboard.container.default :title='"Images"'>
            @foreach ($exercice->images as $image)
                <img src="{{ $image->url }}" alt="Image de l'exercice" class="aspect-square w-full rounded-lg object-cover">
            @endforeach
        </x-dashboard.container.default>
    </div>
</form>
@endsection
