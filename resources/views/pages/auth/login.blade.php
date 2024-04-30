@extends('layouts.default')

@section('page.content')
<div class="max-w-xl mx-auto p-4 md:p-8 flex flex-col justify-center gap-4 h-screen">

    <h1 class="text-3xl font-bold text-center">MUSCLE MAX 💪🏼</h1>

    <div class="p-4 bg-neutral-50 dark:bg-neutral-900 dark:border-neutral-800 border shadow rounded-xl">
        <form method="POST" action="{{ route('authenticate') }}" class="flex flex-col gap-4">

            @csrf

            @include("components.public.forms.inputs.default", [
                'id' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'placeholder' => 'Votre email musclé',
                'required' => true
            ])

            @include("components.public.forms.inputs.default", [
                'id' => 'password',
                'type' => 'password',
                'label' => 'Mot de passe',
                'placeholder' => 'Votre mot de passe secret',
                'required' => true
            ])

            @include('components.public.buttons.default', [
                'label' => "Je me turbo connecte",
                'type' => 'submit'
            ])
        </form>
    </div>

    <a href="{{ route('registration') }}" class="underline underline-offset-4 text-neutral-500 text-center">Je n'ai pas de compte</a>

</div>
@endsection
