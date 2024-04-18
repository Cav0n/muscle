@extends('layouts.dashboard')

@section('page.title', "En avant guingan")

@section('page.content')
<div class="p-4 md:p-0">
    <p>Bienvenue {{ Auth::user()->firstname }}, bonne séance 💪🏼.</p>
</div>
@endsection
