<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory;

    const NUMBER = 1;
    const SHAPE = 2;

    protected $guarded = [];
    public $incrementing = false;

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
