<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientSalary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'site_id', 'guard_id', 'amount'
    ];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    public function guard_clientSalary()
    {
        return $this->belongsTo('App\Guard');
    }
}
