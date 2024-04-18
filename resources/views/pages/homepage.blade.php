@extends('layouts.default')

@section('page.content')
    <div class="w-full h-full flex items-center justify-center p-4 md:p-8">
        <div class="flex flex-col gap-6 md:gap-8 lg:gap-10 items-center justify-center">
            <p class="text-8xl">
                💪🏼
            </p>
            <p class="text-xl md:text-2xl lg:text-3xl font-bold text-center">
                C'est parti pour une séance de folie
            </p>

            @include('components.public.buttons.link', [
                'label' => 'Connexion',
                'url' => route('login')
            ])
        </div>
    </div>
@endsection
