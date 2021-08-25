<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class user_profile extends Model
{
    protected $fillable = [
        'name',
        'email',
        'gender',
        'contact',
        'uid',
        'image'
    ];
    public $primaryKey = "id";
    public $timestamps = false;
}
