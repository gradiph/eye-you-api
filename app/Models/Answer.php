<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function isCorrect(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1,
        );
    }

    public function results()
    {
        return $this->hasMany(ResultQuestion::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
