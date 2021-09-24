<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    protected $fillable = [
        'banner',
        'date'
    ];
    public $primaryKey = "id";
    public $timestamps = false;
    protected $casts = [ 
        'id' => 'integer',
    ];
}
