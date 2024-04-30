@extends('layouts.modal', [
    'id' => 'seance-invite-modal',
    'title' => 'Inviter un ami'
])

@section('modal.content')
<form action="{{ route('dashboard.seances.invites.store') }}" method="POST" class="flex flex-col gap-4">
    @csrf

    <input type="hidden" name="seance_id" value="{{ $seance?->id ?? null }}">

    @include('components.public.forms.inputs.default', [
        'id' => "email",
        'placeholder' => 'Email de la personne à inviter',
        'label' => "Email du participant",
        'required' => true,
    ])

    @include('components.public.buttons.default', [
        'type' => "submit",
        'label' => "Envoyer l'invitation"
    ])
</form>
@overwrite
