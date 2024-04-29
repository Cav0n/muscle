@extends('layouts.dashboard')

@section('page.title', "Nouvel exercice")

@section('page.buttons')
    @include('components.public.buttons.default', [
        'label' => 'Sauvegarder',
        'type' => 'submit',
        'form' => 'exercice-form'
    ])
@endsection

@section('page.content')
<form id="exercice-form" class="grid md:grid-cols-3 gap-4 md:gap-8" method="POST" action="{{ route('dashboard.exercices.store') }}">
    @csrf

    {{-- Left side --}}
    <div class="md:col-span-2 flex flex-col gap-4 md:gap-8">
        <x-dashboard.container.default :title='"Informations"'>
            @include('components.public.forms.inputs.default', [
                'id' => 'name',
                'label' => "Nom",
                'placeholder' => "Nom de l'exercice"
            ])
        </x-dashboard.container.default>
    </div>

    {{-- Right side --}}
    <div class="flex flex-col gap-4 md:gap-8">
        <x-dashboard.container.default>
            @include('components.public.forms.inputs.select', [
                "id" => "category",
                "label" => "Catégorie",
                "options" => \App\Models\Exercice::categories_available()
            ])
        </x-dashboard.container.default>
    </div>
</form>
@endsection
