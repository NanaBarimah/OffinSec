<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = ['contact_name', 'contact_number', 'site_id'];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
