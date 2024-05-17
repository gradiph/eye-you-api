<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'all_achievements',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => bcrypt($value)
        );
    }

    protected function allAchievements(): Attribute
    {
        return Attribute::make(
            get: function () {
                $acquired = $this->achievements->map(function ($achievement) {
                    $achievement->acquired = true;
                    return $achievement;
                });
                $notAcquired = Achievement::whereNotIn('id', $acquired->map(fn ($achievement) => $achievement->id))
                    ->get()
                    ->map(function ($achievement) {
                        $achievement->acquired = false;
                        return $achievement;
                    });
                return $acquired->merge($notAcquired)
                    ->sortBy('order');
            }
        );
    }
    
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class)
        ->using(AchievementUser::class)
        ->withTimestamps();
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
