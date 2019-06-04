<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientSalary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'guard_id', 'amount',
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function guard_clientSalary()
    {
        return $this->belongsTo('App\Guard');
    }
}
