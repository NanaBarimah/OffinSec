<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guard_id', 'amount', 'bank_name', 'bank_branch', 'total_deductions', 'month',
    ];

    public function guard_salary()
    {
        return $this->belongsTo('App\Guard', 'guard_id');
    }
}
