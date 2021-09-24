<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\Common;
use App\model\banner;

class apiSaleController extends Controller
{
    public function getBanners(Request $request){
        
        $banner=banner::orderBy('date', 'DESC')->get();
       
        foreach($banner as  $bannerItem){
            $bannerItem->banner="http://qbuy.lk/banners/".$bannerItem->banner;
        }
        
        return Common::json(true,$banner,'all banners');
    }
}
