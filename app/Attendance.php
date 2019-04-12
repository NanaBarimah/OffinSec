<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guard_id', 'site_id', 'date_time'
    ];


    public function owner_guard()
    {
        return $this->belongsTo('App\Guard', 'guard_id');
    }

    public function site(){
        return $this->belongsTo('App\Site');
    }
}
