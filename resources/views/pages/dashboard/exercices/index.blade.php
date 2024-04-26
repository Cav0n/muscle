@extends('layouts.dashboard')

@section('page.title', "Mes exercices")

@section('page.content')

@if (\App\Models\Exercice::count() <= 0)
<div class="p-4 md:p-0">
    <p>Il semblerait que vous n'ayez aucun exercice pour le moment...</p>
</div>
@else

@endif
@endsection
