<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incident extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'incident', 'action_taken', 'site_id'
    ];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
