<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guard extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'guards';

    public $incrementing  = false;

    protected $fillable = [
        'firstname', 'lastname', 'dob', 'gender', 'marital_status', 'occupation', 'address', 'national_id', 'phone_number', 'SSNIT', 'emergency_contact', 'photo'
    ];

    public function fingerprint()
    {
        return $this->hasOne('App\Fingerprint');
    }

    public function guarantors()
    {
        return $this->hasMany('App\Guarantor', 'guard_id');
    }

    public function duty_rosters()
    {
        return $this->belongsToMany('App\Duty_Roster', 'guard_roster', 'duty_roster_id', 'guard_id')
        ->withPivot('shift_type_id', 'day')
        ->join('shift_types', 'shift_type_id', '=', 'shift_types.id')
        ->select('duty_rosters.*','shift_types.name as pivot_shift_type_name')
        ->withTimestamps();
    }
    
    public function attendances()
    {
        return $this->hasMany('App\Attendance', 'guard_id');
    }

    public function deductions()
    {
        return $this->belongsToMany('App\Deduction', 'deduction_guard')->withTimestamps();
    }

    public function permissions()
    {
        return $this->hasMany('App\Permission', 'guard_id');
    }

}
