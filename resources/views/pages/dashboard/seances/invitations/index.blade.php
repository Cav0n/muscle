@extends('layouts.dashboard')

@section('page.title', "Mes invitations reçues")

@section('page.content')
<livewire:tables.seance-invite-table />
@endsection
