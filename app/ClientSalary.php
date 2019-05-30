<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientSalary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'site_id', 'role', 'amount'
    ];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
