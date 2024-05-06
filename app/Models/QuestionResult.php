<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuestionResult extends Pivot
{
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
