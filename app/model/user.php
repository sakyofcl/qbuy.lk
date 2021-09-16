<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $fillable = [
        'phone',
        'password',
        'verify_key',
        'status',
        'verified',
        'level',
        'date',
    ];
    public $primaryKey = "uid";
    public $timestamps = false;

    protected $casts = [ 
        'uid' => 'integer',
        'phone'=> 'integer',
    ];

}
