<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class order_stage extends Model
{
    protected $fillable = [
        'stage',
        'oid',
    ];
    public $primaryKey = "id";
    public $timestamps = false;
}
