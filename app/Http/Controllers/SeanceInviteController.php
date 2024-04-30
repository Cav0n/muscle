<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeanceInviteRequest;
use App\Http\Requests\UpdateSeanceInviteRequest;
use App\Models\Seance;
use App\Models\SeanceInvite;
use Illuminate\Support\Facades\Auth;

class SeanceInviteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeanceInviteRequest $request)
    {
        $request->request->add([
            'invited_by_id' => Auth::id()
        ]);

        $seanceInvite = SeanceInvite::updateOrCreate($request->except('_token'));

        return redirect(route('dashboard.seances.edit', [
            'seance' => $seanceInvite->seance
        ]))
            ->withSuccess("L'invitation pour {$seanceInvite->email} a été envoyée !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeanceInvite $seanceInvite)
    {
        $seanceInvite->delete();

        return redirect(route('dashboard.seances.edit', [
            'seance' => $seanceInvite->seance
        ]))
            ->withSuccess("L'invitation pour {$seanceInvite->email} a été supprimée !");
    }

    /**
     * Accept a seance invite.
     */
    public function accept(SeanceInvite $seanceInvite)
    {
        $seance = $seanceInvite->seance;

        $seance->users()->syncWithoutDetaching($seanceInvite->user->id);

        $seanceInvite->delete();

        return redirect(route('dashboard.seances.edit', ['seance' => $seance]))
            ->withSuccess("Vous avez accepté l'invitation de {$seanceInvite->invited_by?->firstname}");
    }
}
