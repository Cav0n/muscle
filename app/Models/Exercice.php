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
        'level',
        'force',
        'equipment',
        'primary_muscles',
        'secondary_muscles',
        'instructions'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'primary_muscles' => 'array',
            'secondary_muscles' => 'array',
            'instructions' => 'array',
        ];
    }

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

    /** Images of the exercice. */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class)
            ->withPivot('number')
            ->orderByPivot('number');
    }

    /**
     * Get the availables categories.
     */
    public static function categories_available()
    {
        $categories = [
            "arms" => __("arms"),
            "legs" => __("legs"),
            "back" => __("back"),
            "shoulders" => __("shoulders"),
            "pectorals" => __("pectorals"),
            "abs" => __("abs"),
        ];

        asort($categories);

        return $categories;
    }
}
