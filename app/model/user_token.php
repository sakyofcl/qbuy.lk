<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class user_token extends Model
{
    protected $fillable = [
        'uid',
        'access_token',
    ];
    public $primaryKey = "token_id";
    public $timestamps = false;
}
