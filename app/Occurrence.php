<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occurrence extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'occurrence', 'site_id'
    ];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
