@extends('layouts.dashboard')

@section('page.title', $seance->date->format('d/m/Y'))

@section('page.buttons')
    @include('components.public.buttons.default', [
        'label' => 'Sauvegarder',
        'type' => 'submit',
        'form' => 'seance-form'
    ])
@endsection

@section('page.content')
<form id="seance-form" class="grid md:grid-cols-3 gap-4 md:gap-8" method="POST" action="{{ route('dashboard.seances.update', ['seance' => $seance]) }}">
    @csrf

    {{-- Left side --}}
    <div class="md:col-span-2 flex flex-col gap-4 md:gap-8 order-2 md:order-1">
        <x-dashboard.container.default :title='"Exercices"'>
            <div class="flex flex-wrap gap-2">
                @include('components.public.buttons.default', [
                    'label' => "Ajouter un exercice"
                ])
            </div>
        </x-dashboard.container.default>

        <x-dashboard.container.default :title='"Participants"'>
            <div class="flex flex-wrap gap-2">
                @include('components.public.buttons.default', [
                    'label' => "Inviter un ami"
                ])
            </div>

            @foreach ($seance->users as $user)
                <div class="px-4 py-2 rounded-md bg-neutral-50 border shadow flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        @if ($user->id == $seance->initiated_by_id)
                            <x-heroicon-o-sparkles class="w-5 h-5 flex-shrink-0"/>
                        @endif

                        <p>{{ $user->firstname }} {{ $user->lastname }}</p>
                    </div>
                </div>
            @endforeach
        </x-dashboard.container.default>
    </div>

    {{-- Right side --}}
    <div class="flex flex-col gap-4 md:gap-8 order-1 md:order-2">
        <x-dashboard.container.default :title='"Informations"'>
            @include('components.public.forms.inputs.default', [
                "id" => "date",
                'type' => 'date',
                "label" => "Date",
                'value' => $seance->date->format("Y-m-d"),
                'required' => true
            ])
        </x-dashboard.container.default>
    </div>
</form>
@endsection
