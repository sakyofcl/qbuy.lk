<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    protected $fillable = [
        'pid',
        'offer_price',
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
        'offer_price'=>'integer',
    ];

}
