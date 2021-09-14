<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'sold_count',
        'unit_weight',
        'unit',
        'image',
        'date',
        'cid',
        'sub_id',
        'description',
        'key_tag'
    ];
    public $primaryKey = "pid";
    public $timestamps = false;

    protected $casts = [ 
        'pid' => 'integer',
        'price'=> 'integer',
        'stock'=> 'integer',
        'sold_count' => 'integer',
        'unit_weight'=> 'integer',
        'cid' => 'integer',
        'sub_id'=> 'integer',
    ];

}
