<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'template'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
