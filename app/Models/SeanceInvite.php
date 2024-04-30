<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeanceInvite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'user_id',
        'invited_by_id',
        'seance_id',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($seanceInvite) {
            if (null != $user = User::where('email', $seanceInvite->email)->first()) {
                $seanceInvite->updateQuietly([
                    'user_id' => $user->id
                ]);
            }
        });
    }

    /** The invited user (if exists). */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** The user who sent the invite. */
    public function invited_by(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** The seance of the invite. */
    public function seance(): BelongsTo
    {
        return $this->belongsTo(Seance::class);
    }
}
