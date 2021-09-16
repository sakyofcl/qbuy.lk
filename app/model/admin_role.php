<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class admin_role extends Model
{
    protected $fillable = [
        'role',
    ];

    public $timestamps = false;


}
