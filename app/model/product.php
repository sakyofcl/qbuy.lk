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
        'description'
    ];
    public $primaryKey = "pid";
    public $timestamps = false;
}
