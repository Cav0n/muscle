<?php

namespace App\Livewire\Components\Dashboard;

use App\Models\Exercice;
use App\Models\Seance;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Livewire\Component;

class SeanceExercice extends Component
{
    public ?Exercice $exercice;
    public ?Seance $seance;

    public ?int $number_of_reps;
    public ?int $number_of_series;
    public ?float $weight;

    public function mount()
    {
        $this->number_of_reps = $this->exercice->pivot->number_of_reps;
        $this->number_of_series = $this->exercice->pivot->number_of_series;
        $this->weight = $this->exercice->pivot->weight;
    }

    public function render()
    {
        return view('livewire.components.dashboard.seance-exercice');
    }

    public function updated($property, $value)
    {
        $this->seance->exercices()
            ->updateExistingPivot($this->exercice->id, [
                $property => $value
            ]);
    }
}
