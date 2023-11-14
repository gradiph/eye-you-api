<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    const FIRST_LOGIN = 1;
    const FINISH_NUMBER_MODE = 2;
    const REACH_SCORE_500 = 3;
    const FINISH_SHAPE_MODE = 4;

    protected $guarded = [];
    public $incrementing = false;

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(AchievementUser::class)
            ->withTimestamps();
    }
}
