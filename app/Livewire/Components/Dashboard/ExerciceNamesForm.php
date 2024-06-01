<?php

namespace App\Livewire\Components\Dashboard;

use App\Models\Exercice;
use Livewire\Component;

class ExerciceNamesForm extends Component
{
    public Exercice $exercice;
    public string $lang = "fr";
    public ?string $newExerciceName = null;
    public ?array $otherNames = [];

    public function mount()
    {
        $this->otherNames = $this->exercice->other_names;
    }

    public function render()
    {
        return view('livewire.components.dashboard.exercice-names-form');
    }

    public function save()
    {
        $this->otherNames[$this->lang][] = $this->newExerciceName;

        $this->exercice->update([
            'other_names' => $this->otherNames
        ]);

        $this->newExerciceName = null;
    }

    public function deleteOtherName($index)
    {
        unset($this->otherNames[$this->lang][$index]);

        $this->exercice->update([
            'other_names' => $this->otherNames
        ]);
    }
}
