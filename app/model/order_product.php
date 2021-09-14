<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class order_product extends Model
{
    protected $fillable = [
        'oid',
        'pid',
        'name',
        'price',
        'qty'
    ];
    public $primaryKey = "id";
    public $timestamps = false;

    protected $casts = [ 
        'oid' => 'integer', 
        'pid' => 'integer', 
        'price' => 'integer', 
        'qty' => 'integer', 
        'id' => 'integer'
    ];
}
