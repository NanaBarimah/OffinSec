<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guard_id', 'reliever', 'reason', 'date',
    ];

    public function guard()
    {
        return $this->belongsTo('App\Guard');
    }
}
