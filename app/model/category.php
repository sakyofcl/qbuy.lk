<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name'
    ];
    public $primaryKey = "cid";
    public $timestamps = false;

    public function subCategory()
    {
        return $this->hasMany('App\model\sub_category', 'cid');
    }
}
