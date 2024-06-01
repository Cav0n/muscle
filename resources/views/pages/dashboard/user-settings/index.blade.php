@extends('layouts.dashboard')

@section('page.title', "Mes paramètres")

@section('page.content')
<x-dashboard.container.default :title='"Langue"'>
    <form action="">
        @include('components.public.forms.inputs.select', [
            'label' => 'Langue',
            'id' => 'language',
            'options' => [
                'fr' => 'Français',
                'en' => 'Anglais'
            ]
        ])
    </form>
</x-dashboard.container.default>
@endsection
