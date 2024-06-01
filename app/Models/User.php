<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\Users\UserRegisteredConfirmation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($user) {
            $user->notify(new UserRegisteredConfirmation($user));

            SeanceInvite::where('email', $user->email)->update(['user_id' => $user->id]);
        });
    }

    /** Seances of the user. */
    public function seances(): BelongsToMany
    {
        return $this->belongsToMany(Seance::class);
    }

    /** Invitation sent to the user. */
    public function invitations_received(): HasMany
    {
        return $this->hasMany(SeanceInvite::class, 'user_id');
    }

    /** Settings of the user. */
    public function settings(): HasMany
    {
        return $this->hasMany(UserSetting::class);
    }
}
