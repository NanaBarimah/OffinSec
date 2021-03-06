<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'name', 'location', 'phone_number', 'access_code'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function duty_roster()
    {
        return $this->hasOne('App\Duty_Roster');
    }

    public function attendances(){
        return $this->hasMany('App\Attendance');
    }

    public function incidents()
    {
        return $this->hasMany('App\Incident', 'site_id');
    }

    public function occurrences()
    {
        return $this->hasMany('App\Occurrence', 'site_id');
    }
}
