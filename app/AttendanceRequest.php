<?php

namespace App;
use Attendance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guard_id', 'site_id', 'date_time', 'image',
    ];

    public function owner_guard()
    {
        return $this->belongsTo('App\Guard', 'guard_id');
    }

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    private function generateAttendance()
    {
        $attendance = new Attendance();
        
        $attendance->site_id = $this->site_id;
        $attendance->guard_id = $this->guard_id;
        $attendance->date_time = $this->date_time;
        $attendance->type = $this->type;

        return $attendance;
    }
}
