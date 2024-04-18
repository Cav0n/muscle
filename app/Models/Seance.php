<?php

namespace App\Models;

use App\Models\Pivots\ExerciceSeanceUserPivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Seance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'initiated_by_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    /** The user who initiate the seance. */
    public function initiated_by(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Exercices of the seance. */
    public function exercices(): BelongsToMany
    {
        return $this->belongsToMany(Exercice::class)
            ->withPivot([
                'number_of_reps',
                'number_of_series',
                'weight'
            ])
            ->using(ExerciceSeanceUserPivot::class);
    }

    /** Users of the seance. */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
