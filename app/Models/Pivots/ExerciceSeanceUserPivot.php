<?php

namespace App\Models\Pivots;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExerciceSeanceUserPivot extends Pivot
{
    use HasFactory;

    // User of the exercice in the seance
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
