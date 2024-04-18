<?php

namespace App\Models;

use App\Models\Pivots\ExerciceSeanceUserPivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
    ];

    /** Seances of the exercice. */
    public function seances(): BelongsToMany
    {
        return $this->belongsToMany(Seance::class)
            ->withPivot([
                'number_of_reps',
                'number_of_series',
                'weight'
            ])
            ->using(ExerciceSeanceUserPivot::class);
    }
}
