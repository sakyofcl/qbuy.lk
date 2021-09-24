<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\Common;
use App\model\banner;

class apiSaleController extends Controller
{
    public function getBanners(Request $request){
        
        $banner=banner::all()->sortByDesc('date');
        for ($i=0; $i <count($banner) ; $i++) { 
            $banner[$i]['banner']="http://qbuy.lk/banners/".$banner[$i]['banner'];
        }
        return Common::json(true,$banner,'all banners');
    }
}
