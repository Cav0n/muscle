@extends('layouts.dashboard')

@section('page.title', "Mes séances")

@section('page.buttons')
@include('components.public.buttons.link', [
    'label' => 'Nouveau',
    'url' => route('dashboard.seances.create')
])
@endsection

@section('page.content')
<livewire:tables.seance-table />
@endsection
