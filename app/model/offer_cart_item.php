<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class offer_cart_item extends Model
{
    protected $fillable = [
        'offer',
        'qty',
        'cart_id'
    ];
    public $primaryKey = "offer_cart_id";
    public $timestamps = false;

    protected $casts = [ 
        'offer' => 'integer', 
        'qty' => 'integer',
        'cart_id'=> 'integer',
        "offer_cart_id"=>'integer',
    ];
}
