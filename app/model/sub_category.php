<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    protected $fillable = [
        'name',
        'cid'
    ];
    public $primaryKey = "sub_id";
    public $timestamps = false;
}
