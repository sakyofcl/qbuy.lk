<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class order_address extends Model
{
    protected $fillable = [
        'customer_name',
        'street',
        'city',
        'province',
        'zip',
        'contact',
        'oid'
    ];
    public $primaryKey = "order_addr_id";
    public $timestamps = false;

    protected $casts = [ 
        'order_addr_id' => 'integer',
        'contact'=> 'integer',
        'oid'=>'integer',
    ];

}
