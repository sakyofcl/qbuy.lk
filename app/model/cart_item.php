<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class cart_item extends Model
{
    protected $fillable = [
        'pid',
        'qty',
        'cart_id'
    ];
    public $primaryKey = "cart_item_id";
    public $timestamps = false;
}
