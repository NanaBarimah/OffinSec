<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Duty_Roster extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'site_id', 'name'
    ];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    public function guards()
    {
        return $this->belongsToMany('App\Guard', 'guard_roster')->withPivot('shift_type_id', 'day')->withTimestamps();
    }
}
