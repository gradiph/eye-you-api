<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use HasFactory, SoftDeletes;

    const FIRST_LOGIN = 1;
    const FINISH_NUMBER_MODE = 2;
    const REACH_SCORE_500 = 3;
    const FINISH_SHAPE_MODE = 4;
    const REACH_SCORE_1500 = 5;
    const FINISH_ISHIHARA_MODE = 6;
    const REACH_SCORE_5000 = 7;
    const REACH_SCORE_7500 = 8;
    const REACH_SCORE_10000 = 9;
    const ALL_ANSWER_CORRECT = 10;

    protected $guarded = [];
    public $incrementing = false;

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(AchievementUser::class)
            ->withTimestamps();
    }
}
