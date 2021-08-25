<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class product_stock_status extends Model
{
    protected $fillable = [
        'pid',
        'status'
    ];
    public $primaryKey = "id";
    public $timestamps = false;
}
