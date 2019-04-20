<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deduction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'penalty'
    ];

    public function guards()
    {
        return $this->belongsToMany('App\Guard', 'deduction_guard')->withPivot('date', 'details', 'amount')->withTimestamps();
    }
}
