<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function results()
    {
        return $this->hasMany(ResultQuestion::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
