<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

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


            #askingfeild
            $field=[];
            if($request->header('feild')){
                $item=explode(",",$request->header('feild'));
                
                for ($i=0; $i <count($item) ; $i++) { 
                    
                    if(Schema::hasColumn('products', $item[$i])){
                        $field[]=$item[$i];
                    }
                }

                
            }
            else{
                return response()->json(['status'=>false,'data'=> [],'message'=>"must mention feild you want."]);
            }


            if(!count($field)){
                return response()->json(['status'=>false,'data'=> $field,'message'=>"not matching feild..!"]);
            }
            
            

            #return response()->json(['status'=>true,'data'=> $ask,'message'=>"by all"]);

            #common all search
            $data=product::query()
            ->orWhere('key_tag', 'LIKE', "%{$ask}%") 
            ->orWhere('name', 'LIKE', $request->q)
            ->orderBy('date','DESC')
            ->take(30)
            ->get($field);

            if(count($data)>0){
                
                if(in_array('image',$field)){
                    foreach ($data as  $dataItem){
                        $dataItem->image="http://qbuy.lk/products/".$dataItem->image;
                    }
                }

                
                return response()->json(['status'=>true,'data'=> $data,'message'=>"by all"]);
            }
            else{
                return response()->json(['status'=>false,'data'=> [],'message'=>"nothing..!"]);
            }

           
        }

        
        
        
        
    }
}
