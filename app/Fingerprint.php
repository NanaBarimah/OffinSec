<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fingerprint extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'guard_id';

    public $incrementing = false;

    protected $fillable = [
        'guard_id', 'RTB64', 'LTB64', 'RTISO', 'LTISO'
    ];

    public function guard()
    {
        return $this->belongsTo('App\Guard');
    }
}
