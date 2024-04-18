@extends('layouts.default')

@section('page.content')
<div class="max-w-xl mx-auto p-4 md:p-8">
    <div class="p-4 bg-neutral-50 border shadow rounded">
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
</div>
@endsection
