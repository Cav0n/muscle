<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeanceRequest;
use App\Http\Requests\UpdateSeanceRequest;
use App\Models\Exercice;
use App\Models\Seance;
use Illuminate\Support\Facades\Auth;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.seances.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.seances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeanceRequest $request)
    {
        $request->merge([
            'initiated_by_id' => Auth::id()
        ]);

        $seance = Seance::create($request->toArray());

        return redirect(route('dashboard.seances.edit', ['seance' => $seance]))
            ->withSuccess("La séance du {$seance->date->format('d/m/Y')} à été créée !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Seance $seance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seance $seance)
    {
        return view('pages.dashboard.seances.edit', ['seance' => $seance]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeanceRequest $request, Seance $seance)
    {
        $seance->update($request->toArray());

        return redirect(route('dashboard.seances.index'))
            ->withSuccess("La séance du {$seance->date->format('d/m/Y')} à été mise à jour !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seance $seance)
    {
        $seance->delete();

        return back()
            ->withSuccess('Seance supprimée.');
    }

    /** Add an exercice to a seance. */
    public function addExerciceToSeance(UpdateSeanceRequest $request, Seance $seance)
    {
        $request->validate([
            'exercice_id' => 'required|exists:exercices,id'
        ]);

        $seance->exercices()
            ->syncWithoutDetaching([
                $request->exercice_id => [
                    'user_id' => Auth::id()
                ]
            ]);

        return back()
            ->withSuccess("L'exercice a été ajouté à la séance !");
    }

    /** Remove an exercice from a seance. */
    public function removeExerciceFromSeance(
        UpdateSeanceRequest $request,
        Seance $seance,
        Exercice $exercice
    ) {
        $seance->exercices()
            ->wherePivot('user_id', Auth::id())
            ->detach($exercice->id);

        return back()
            ->withSuccess("L'exercice a été ajouté à la séance !");
    }
}
