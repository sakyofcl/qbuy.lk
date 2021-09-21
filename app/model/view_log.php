<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class view_log extends Model
{
    protected $fillable = [
        'log_id',
        'item',
        'uid',
        'date'
    ];
    public $primaryKey = "log_id";
    public $timestamps = false;

    protected $casts = [ 
        'log_id' => 'integer',
        'uid'=>'integer',
    ];

}
