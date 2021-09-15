<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function user(){
        return view('admin/user/user');
    }
    public function userInfo(){
        return view('admin/user/user-info');
    }
    
}
