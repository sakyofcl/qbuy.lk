<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\banner;
class saleController extends Controller
{
    public function addBanner(Request $request){
        $storepath = public_path('./banners');
        if (isset($request->banner)) {
            $store=new banner;
            
            $image = $request->file('banner');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($storepath,  $imageName);
            $store->banner=$imageName;

            if($store->save()){
                return "ok";
            }
  
        }
    }
}
