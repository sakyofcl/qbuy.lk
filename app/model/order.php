<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'address_id',
        'status',
        'payment',
        'date',
        'uid'
    ];
    public $primaryKey = "oid";
    public $timestamps = false;
}
