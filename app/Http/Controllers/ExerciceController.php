<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciceRequest;
use App\Http\Requests\UpdateExerciceRequest;
use App\Models\Exercice;
use Illuminate\Support\Facades\Auth;

class ExerciceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.exercices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.exercices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciceRequest $request)
    {
        $exercice = Exercice::create($request->toArray());

        return redirect(route('dashboard.exercices.index'))
            ->withSuccess("L'exercice {$exercice->name} a été créé.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercice $exercice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercice $exercice)
    {
        return view('pages.dashboard.exercices.edit', [
            'exercice' => $exercice
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExerciceRequest $request, Exercice $exercice)
    {
        $exercice->update($request->toArray());

        return redirect(route('dashboard.exercices.index'))
            ->withSuccess("L'exercice {$exercice->name} a été mis à jour.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercice $exercice)
    {
        $name = $exercice->name;

        $exercice->delete();

        return redirect(route('dashboard.exercices.index'))
            ->withSuccess("L'exercice {$name} a été supprimé.");
    }

    /** Add the exercice to the user favorites. */
    public function toggleFavorite(Exercice $exercice)
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        $user->exercice_favorites()->toggle([$exercice->id]);

        return back()->with('success', "Modification effectuée.");
    }
}
