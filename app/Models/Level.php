<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes;

    const EASY = '1';
    const NORMAL = '5';
    const HARD = '9';

    protected $guarded = [];

    public function mode()
    {
        return $this->belongsTo(Mode::class);
    }

    public function tests()
    {
        return $this->hasMany(TestLevel::class);
    }
}
