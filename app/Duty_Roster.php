<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Duty_Roster extends Model
{
    use SoftDeletes;

    protected $table = 'duty_rosters';

    protected $fillable = [
        'site_id', 'name'
    ];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    public function guards()
    {
        return $this->belongsToMany('App\Guard', 'guard_roster', 'duty_roster_id', 'guard_id')
        ->withPivot('shift_type_id', 'day')
        ->join('shift_types', 'shift_type_id', '=', 'shift_types.id')
        ->select('guards.*','shift_types.name as pivot_shift_type_name')
        ->withTimestamps();
    }
}
