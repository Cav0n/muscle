@extends('layouts.dashboard')

@section('page.title', "Nouvelle séance")

@section('page.buttons')
    @include('components.public.buttons.default', [
        'label' => 'Sauvegarder',
        'type' => 'submit',
        'form' => 'seance-form'
    ])
@endsection

@section('page.content')
<form id="seance-form" class="grid md:grid-cols-3 gap-4 md:gap-8" method="POST" action="{{ route('dashboard.seances.store') }}">
    @csrf

    {{-- Left side --}}
    <div class="md:col-span-2 flex flex-col gap-4 md:gap-8">
        <x-dashboard.container.default>
            <p class="text-neutral-700">Selectionnez la date sur la droite puis sauvegardez pour initier la séance !</p>
        </x-dashboard.container.default>
    </div>

    {{-- Right side --}}
    <div class="flex flex-col gap-4 md:gap-8">
        <x-dashboard.container.default :title='"Informations"'>
            @include('components.public.forms.inputs.default', [
                "id" => "date",
                'type' => 'date',
                "label" => "Date",
                "required" => true
            ])
        </x-dashboard.container.default>
    </div>
</form>
@endsection
