<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultQuestion extends Model
{
    protected $guarded = [];
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function result()
    {
        return $this->belongsTo(Result::class);
    }
}
