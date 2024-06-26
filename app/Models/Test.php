<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function mode()
    {
        return $this->belongsTo(Mode::class);
    }

    public function levels()
    {
        return $this->hasMany(TestLevel::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
