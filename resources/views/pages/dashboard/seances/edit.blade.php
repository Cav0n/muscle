@extends('layouts.dashboard')

@section('page.title', $seance->date->format('d/m/Y'))

@section('page.content')
<form id="seance-form" class="grid md:grid-cols-3 gap-4 md:gap-8" method="POST" action="{{ route('dashboard.seances.update', ['seance' => $seance]) }}">
    @csrf

    {{-- Left side --}}
    <div class="md:col-span-2 flex flex-col gap-4 md:gap-8 order-2 md:order-1">
        <x-dashboard.container.default :title='"Exercices"'>
            <div class="flex flex-wrap gap-2">
                @include('components.public.buttons.default', [
                    'label' => "Ajouter un exercice",
                    'modalId' => "seance-exercice-modal"
                ])
            </div>

            @forelse ($seance->exercices as $exercice)
                @livewire('components.dashboard.seance-exercice', [
                    'exercice' => $exercice,
                    'seance' => $seance
                ])
            @empty
                <p class="text-neutral-500">Vous n'avez pas ajouté d'exercice... Qu'attendez-vous ? 💪🏼</p>
            @endforelse
        </x-dashboard.container.default>

        <x-dashboard.container.default :title='"Participants"'>
            <div class="flex flex-wrap gap-2">
                @include('components.public.buttons.default', [
                    'label' => "Inviter un ami",
                    'modalId' => "seance-invite-modal"
                ])
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($seance->users as $user)
                    <div class="p-3 rounded-md bg-neutral-50 border shadow flex flex-col gap-2">
                        <div class="bg-neutral-200 aspect-square rounded-lg w-full">

                        </div>
                        <div class="flex items-center justify-center gap-2">
                            @if ($user->id == $seance->initiated_by_id)
                                <x-heroicon-o-sparkles class="w-5 h-5 flex-shrink-0"/>
                            @endif

                            <p>{{ $user->firstname }} {{ $user->lastname }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-neutral-500 md:col-span-2 lg:col-span-3">Aucun participant n'a été ajouté à la séance.</p>
                @endforelse
            </div>


            <p class="text-xl md:text-2xl font-semibold">Invitations</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($seance->invites as $seanceInvite)
                    <div class="p-3 rounded-md bg-neutral-50 border shadow flex flex-col gap-2">
                        <div class="bg-neutral-200 aspect-square rounded-lg w-full">

                        </div>
                        <div class="flex items-center justify-center gap-2">
                            <div class="flex flex-col justify-center truncate text-center">
                                @if ($seanceInvite->user == null)
                                    <p class="text-neutral-500">{{ "Invité" }}</p>
                                @else
                                    <p class="font-medium">{{ $seanceInvite?->user?->firstname }}</p>
                                @endif
                                <p class="text-neutral-600 text-sm">{{ $seanceInvite->email }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-neutral-500 md:col-span-2 lg:col-span-3">Aucune invitation n'a été envoyée.</p>
                @endforelse
            </div>
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
                'required' => true,
                'disabled' => true
            ])
        </x-dashboard.container.default>
    </div>
</form>
@endsection

@include('components.dashboard.modals.seance-invite')
@include('components.dashboard.modals.seance-exercice')
