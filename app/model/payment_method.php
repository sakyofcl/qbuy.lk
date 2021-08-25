<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class payment_method extends Model
{
    protected $fillable = [
        'payment',
    ];
    public $timestamps = false;
}
