<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guarantor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guard_id', 'firstname', 'lastname', 'dob', 'gender', 'occupation', 'address', 'phone_number', 'national_id'
    ];

    public function owner_guard()
    {
        return $this->belongsTo('App\Guard');
    }
}
