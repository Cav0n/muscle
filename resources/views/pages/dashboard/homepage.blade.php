@extends('layouts.dashboard')

@section('page.title', "Bienvenue ".Auth::user()->firstname ." et bonne séance 💪🏼")

@section('page.content')
<div class="px-4 md:px-0 flex flex-col gap-4 items-start">
    @if (null != $todaySeance = Auth::user()->seances()->whereDate('date', now()->format("Y-m-d"))->first())
        @include('components.public.buttons.link', [
            'label' => 'Je continue ma séance',
            'url' => route('dashboard.seances.edit', ['seance' => $todaySeance])
        ])
    @else
        <p>Prêt pour ta séance du jour ?</p>
        @include('components.public.buttons.link', [
            'label' => 'Je créé ma séance',
            'url' => route('dashboard.seances.store', [
                'date' => now()->format('Y-m-d')
            ])
        ])
    @endif
</div>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8 px-4 md:px-0">
    <div class="p-4 rounded-xl flex flex-col justify-center items-center text-center bg-neutral-100 dark:bg-neutral-800">
        <p class="text-2xl lg:text-4xl font-bold">{{ Auth::user()->seances->count() }}</p>
        <p class="text-sm md:text-base lg:text-lg xl:text-xl">Séances effectuées</p>
    </div>
    <div class="p-4 rounded-xl flex flex-col justify-center items-center text-center bg-neutral-100 dark:bg-neutral-800">
        <p class="text-2xl lg:text-4xl font-bold">{{ Auth::user()->seances()->count() }}</p>
        <p class="text-sm md:text-base lg:text-lg xl:text-xl">Exercices effectuées</p>
    </div>
    <div class="p-4 rounded-xl flex flex-col justify-center items-center text-center bg-neutral-100 dark:bg-neutral-800">
        <p class="text-2xl lg:text-4xl font-bold">{{ Auth::user()->seances->count() }} kg</p>
        <p class="text-sm md:text-base lg:text-lg xl:text-xl">Soulevés !</p>
    </div>
</div>
@endsection
