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

    public function owner_guard()
    {
        return $this->belongsTo('App\Guard', 'guard_id', 'id');
    }

    public function relieving_guard(){
        return $this->belongsTo('App\Guard', 'reliever', 'id');
    }
}
