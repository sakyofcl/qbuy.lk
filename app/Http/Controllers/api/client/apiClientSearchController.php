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

        if($request->q){

            #final string;
            $ask=" ";
            #explode word by " "
            $word=explode(" ",$request->q);

            foreach($word as $wordItem){
                $ask.=metaphone($wordItem)." ";
            }

            #return response()->json(['status'=>true,'data'=> $ask,'message'=>"by all"]);

            #common all search
            $data=product::query()
            ->where('key_tag', 'LIKE', "%{$ask}%") 
            ->orWhere('name', 'LIKE', $request->q)
            ->orderBy('date','DESC')
            ->take(30)
            ->get(['name','pid','image']);

            if(count($data)>0){
                foreach ($data as  $dataItem){
                    $dataItem->image="http://qbuy.lk/products/".$dataItem->image;
                }
                return response()->json(['status'=>true,'data'=> $data,'message'=>"by all"]);
            }
            else{
                return response()->json(['status'=>false,'data'=> [],'message'=>"nothing..!"]);
            }

           
        }

        
        
        
        
    }
}
