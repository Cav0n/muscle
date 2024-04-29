@extends('layouts.dashboard')

@section('page.title', "Bienvenue ".Auth::user()->firstname ." et bonne séance 💪🏼")

@section('page.content')

@if (Auth::user()->seances->count() <= 0)
<div class="px-4 md:p-0">
    <p>Il semblerait que vous n'ayez aucune séance pour le moment...</p>
</div>
@else

@endif
@endsection
