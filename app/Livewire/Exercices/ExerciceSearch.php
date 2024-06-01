<?php

namespace App\Livewire\Exercices;

use App\Models\Exercice;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ExerciceSearch extends Component
{
    public ?string $search = null;

    public ?Collection $exercices = null;

    public ?Exercice $selectedExercice = null;

    public function render()
    {
        return view('livewire.exercices.exercice-search');
    }

    /** On search updated... */
    public function updatedSearch()
    {
        $this->exercices = Exercice::where('name', 'like', "%{$this->search}%")
            ->orWhere('other_names', 'like', "%{$this->search}%")
            ->orderBy('name')->get();
    }

    /** On exercice selected... */
    public function selectExercice(int $exerciceId)
    {
        $this->selectedExercice = Exercice::find($exerciceId);

        $this->exercices = null;
        $this->search = null;
    }

    /** Unselecting the selected exercice */
    public function unselectExercice()
    {
        $this->selectedExercice = null;
        $this->exercices = null;
        $this->search = null;
    }
}
