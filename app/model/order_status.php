<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class order_status extends Model
{
    protected $fillable = [
        'status',
    ];
    public $timestamps = false;
}
