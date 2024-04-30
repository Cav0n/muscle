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
@endsection
