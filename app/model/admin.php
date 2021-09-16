<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $fillable = [
        'name',
        'password',
        'email',
        'role',
        'date',
        'verified',
    ];
    public $primaryKey = "aid";
    public $timestamps = false;

    protected $casts = [ 
        'aid' => 'integer',
    ];

}
