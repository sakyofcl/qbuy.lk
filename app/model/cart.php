<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $fillable = [
        'uid',
    ];
    public $primaryKey = "cart_id";
    public $timestamps = false;
    protected $casts = [ 
        'uid' => 'integer', 
        'cart_id' => 'integer'
    ];
}
