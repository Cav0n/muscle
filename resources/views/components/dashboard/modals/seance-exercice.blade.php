@extends('layouts.modal', [
    'id' => 'seance-exercice-modal',
    'title' => 'Ajouter un exercice à la séance'
])

@section('modal.content')
<form action="{{ route('dashboard.seances.exercices.add', ['seance' => $seance]) }}" method="POST" class="flex flex-col gap-4">
    @csrf

    @include('components.public.forms.inputs.select', [
        'id' => 'exercice_id',
        'label' => 'Choisissez un exercice',
        'options' => \App\Models\Exercice::get()->pluck('name', 'id')
    ])

    @include('components.public.buttons.default', [
        'type' => "submit",
        'label' => "Ajouter l'exercice"
    ])
</form>
@overwrite
