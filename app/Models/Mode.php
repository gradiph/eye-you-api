<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mode extends Model
{
    use HasFactory, SoftDeletes;

    const NUMBER = 1;
    const SHAPE = 2;
    const ISHIHARA = 3;

    public $incrementing = false;
    protected $guarded = [];

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
