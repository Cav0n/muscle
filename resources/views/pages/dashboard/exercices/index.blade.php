@extends('layouts.dashboard')

@section('page.title', "Mes exercices")

@section('page.buttons')
@include('components.public.buttons.link', [
    'label' => 'Nouveau',
    'url' => route('dashboard.exercices.create')
])
@endsection

@section('page.content')
<livewire:tables.exercice-table />
@endsection
