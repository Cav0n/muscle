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

            @forelse ($seance->users as $user)
                <div class="px-4 py-2 rounded-md bg-neutral-50 border shadow flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        @if ($user->id == $seance->initiated_by_id)
                            <x-heroicon-o-sparkles class="w-5 h-5 flex-shrink-0"/>
                        @endif

                        <p>{{ $user->firstname }} {{ $user->lastname }}</p>
                    </div>
                </div>
            @empty
                <p class="text-neutral-500">Aucun participant n'a été ajouté à la séance.</p>
            @endforelse

            <p class="text-xl md:text-2xl font-semibold">Invitations</p>
            @forelse ($seance->invites as $seanceInvite)
                <div class="px-4 py-2 rounded-md bg-neutral-50 border shadow flex flex-col gap-2">
                    <div class="flex flex-col lg:flex-row justify-between gap-4">
                        <div class="flex flex-col justify-center truncate">
                            @if ($seanceInvite->user == null)
                                <p class="text-neutral-500">{{ "Invité" }}</p>
                            @else
                                <p class="font-medium">{{ $seanceInvite?->user?->firstname }}</p>
                            @endif
                            <p class="text-neutral-600 text-sm">{{ $seanceInvite->email }}</p>
                        </div>

                        <div class="flex flex-row gap-4 md:gap-2 justify-center items-center text-center flex-shrink-0">
                            <a class="p-2 bg-yellow-600 text-white rounded border border-yellow-700 flex gap-2 justify-center items-center transition-all hover:bg-transparent hover:text-yellow-500 w-full">
                                <x-heroicon-o-paper-airplane class="w-4 h-4"/>
                            </a>
                            <div class="pr-4 pl-3 py-1 bg-neutral-200 text-neutral-600 rounded border flex gap-2 justify-center items-center flex-shrink-0">
                                <x-heroicon-o-clock class="w-5 h-5"/>
                                En attente
                            </div>
                            <a href="{{ route('dashboard.seances.invites.destroy', ['seanceInvite' => $seanceInvite]) }}" class="p-2 bg-red-500 text-white rounded border border-red-600 flex gap-2 justify-center items-center transition-all hover:bg-transparent hover:text-red-500 w-full">
                                <x-heroicon-o-trash class="w-4 h-4"/>
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <p class="text-neutral-500">Aucune invitation n'a été envoyée.</p>
            @endforelse
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
