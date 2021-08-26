<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\sub_category;
use App\model\category;

class apiCategoryController extends Controller
{
    public function getSubCategory(Request $data)
    {

        if ($data->cid) {
            $subcat = sub_category::where('cid', $data->cid)->get();

            if ($subcat) {
                return response()->json($subcat, 200);
            } else {
                return response()->json([], 404);
            }
        }
    }

    public function getMainCategory(){
        $maincat=category::all();

        if(isset($maincat) && count($maincat)>0){
            return response()->json(['status'=>true,'data'=>$maincat,'message'=>"get all main categories!"]);
        }
        else{
            return response()->json(['status'=>true,'data'=>[],'message'=>"get all main categories!"]);
        }
        

    }
}
