<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\model\product;
class apiClientSearchController extends Controller
{
    public function userFindProduct(Request $request){

        # by category
        if($request->header('by')){
            if($request->header('by')=='category'){
                if($request->header('cid')){
                    $data=product::query()
                    ->where('cid',$request->header('cid'))
                    ->where('name', 'LIKE', "%{$request->q}%") 
                    ->orderBy('date','DESC')
                    ->take(50)
                    ->get();
                    foreach($data as $dataItem){
                        $dataItem['image']="http://qbuy.lk/products/".$dataItem['image'];
                    }
                    return response()->json(['status'=>true,'data'=> $data,'message'=>"by category"]);
                }
                
            }
            
        }

        #common all search
        $data=product::query()
        ->where('name', 'LIKE', "%{$request->q}%") 
        ->orderBy('date','DESC')
        ->take(50)
        ->get(['name','pid']);
        
        return response()->json(['status'=>true,'data'=> $data,'message'=>"by all"]);
        
    }
}
