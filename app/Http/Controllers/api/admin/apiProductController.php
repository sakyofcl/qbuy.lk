<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\model\product;
use App\model\product_stock_status;

class apiProductController extends Controller
{
    public function storeProduct(Request $data)
    {

        $store = new product;
        

        $store->cid = $data->cid;

        if ($data->name == null) {
            $store->name = "no name";
        } else {
            $store->name = $data->name;
            #final string;
            $ask=" ";
            #explode word by " "
            $word=explode(" ", $data->name);

            foreach($word as $wordItem){
                $ask.=metaphone($wordItem)." ";
            }

            $store->key_tag=$ask;
        }

        $store->price = $data->price;
        $store->description = $data->description;
        $store->stock = $data->stock;
        $store->unit_weight = $data->unitWeight;
        $store->unit = $data->unit;


        # store main image
        $image = $data->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $storepath = public_path('./products');
        $image->move($storepath,  $imageName);
        $store->image = $imageName;


        /*
        $image = $data->file('image')->getRealPath();
        $fileContent = file_get_contents($image);
        $convBase64 = base64_encode($fileContent);
        #$store->image = $convBase64;
        */

        if ($store->save()) {
            #get product id
            $pid = product::orderBy('pid', 'DESC')->first('pid');
            #set product stock status
            $stock_status = new product_stock_status;
            $stock_status->pid = $pid->pid;
            $stock_status->save();

            return response()->json(['message' => "product added", 'status' => 200]);
        } else {
            return response()->json(['message' => "something wrong", 'status' => 404]);
        }
    }

    public  function getProduct(Request $request){

        $cat_Id=$request->header('cat_id');
        if($cat_Id){
            $data=product::where('cid',$cat_Id)->get();

            if(isset($data) && count($data)>0){
            
                foreach($data as $dataItem){
                    $dataItem['image']="http://qbuy.lk/products/".$dataItem['image'];
                }
    
                return response()->json(['status'=>true,'data'=>$data,'message'=>"get product successfully..!"]);
            }
            else{
                return response()->json(['status'=>true,'data'=>[],'message'=>"no product in this category..!"]);
            }

        }
        else{
            return response()->json(['status'=>false,'data'=>[],'message'=>"give your cat_id"]);
        }

       
        
    }

    public function getProductInfo(Request $request){
        if($request->pid){
            $data=product::where('pid',$request->pid)->first();
            if($data){
                $data->image="http://qbuy.lk/products/".$data->image;
                return response()->json(['status'=>true,'data'=>$data,'message'=>"product info."]);
            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"not available!"]);
            }            

        }
        else{
            return response()->json(['status'=>false,'data'=>[],'message'=>"qive pid"]);
        }
    } 
}
