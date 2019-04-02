<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Access_Code extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'access_code'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
