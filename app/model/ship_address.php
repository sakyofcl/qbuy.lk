<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ship_address extends Model
{
    protected $fillable = [
        'name',
        'street',
        'city',
        'province',
        'zip',
        'contact',
        'uid'
    ];
    public $primaryKey = "id";
    public $timestamps = false;
}
