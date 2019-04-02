<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    public $incrementing  = false;

    protected $fillable = [
        'name', 'phone_number', 'email', 'contact_person_name', 'number_of_guards'
    ];

    public function sites()
    {
        return $this->hasMany('App\Site', 'client_id');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function access_codes()
    {
        return $this->hasMany('App\Acces_Code', 'client_id');
    }

}
