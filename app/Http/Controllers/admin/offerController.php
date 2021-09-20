<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\category;

class offerController extends Controller
{
    public function index(){
        $category=category::all();
        return view('/admin/offer/offer',['category'=>$category]);
    }
    public function placeOffer(Request $request){
        return $request->all();
    }
}
