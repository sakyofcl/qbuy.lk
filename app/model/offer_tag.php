<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class offer_tag extends Model
{
    protected $fillable = [
        'tag',
        'date',
    ];
    public $timestamps = false;

}
