<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'phone',
        'status',
        'payment',
        'date',
        'uid'
    ];
    public $primaryKey = "oid";
    public $timestamps = false;
}
