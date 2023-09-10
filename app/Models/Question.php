<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function results()
    {
        return $this->belongsToMany(Result::class)
            ->using(ResultQuestion::class)
            ->withPivot(['answer_id'])
            ->withTimestamps();
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
