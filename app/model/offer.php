<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    protected $fillable = [
        'pid',
        'price',
        'start',
        'end',
        'tag',
        'date',
    ];
    public $primaryKey = "offer_id";
    public $timestamps = false;

    protected $casts = [ 
        'pid' => 'integer',
        'offer_id'=>'integer',
        'price'=>'integer',
    ];

}
