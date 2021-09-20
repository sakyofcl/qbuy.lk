<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getBestSellProducts(){
        $bestSellItem=[];
        $data=DB::table('order_products')
                ->select(
                    [
                       "order_products.pid"
                    ]
                )
                ->groupBy('order_products.pid')
                ->orderByRaw('COUNT(order_products.pid) DESC')
                ->take(20)
                ->get();
            
        foreach($data as $dataItem){
            $item=product::where('pid',$dataItem->pid)->first();
            if($item){
                $item->image="http://qbuy.lk/products/".$item->image;
                $bestSellItem[]=$item;
            }
            
        }
        return response()->json(['status'=>true,'data'=>$bestSellItem,'message'=>"Best sell products"]);
    }

    public function getProductByCategory(Request $request){
        $cat_Id=$request->header('cat_id');
        if($cat_Id){
            $data=product::where('cid',$cat_Id)->get(['pid','name']);

            if(isset($data) && count($data)>0){
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

    public function getProductOffer(Request $request){

        #this is all the offer status
        $status1='active';
        $status2='expired';
        $status3='schedule';
        $currentDate=date_create(date('Y-m-d'));


        $data=DB::table('offers')
        ->select(
            [
                'products.*',
                'offers.offer_id',
                'offers.offer_price',
                'offers.start',
                'offers.end',
            ])
        ->join('products','products.pid','=','offers.pid')
        ->orderBy('offers.date','DESC')
        ->paginate(20);
        

        $finalData=[];
        $next=$data->nextPageUrl()?$data->nextPageUrl():false;
        $prew=$data->previousPageUrl()?$data->nextPageUrl():false;
        foreach($data as $dataItem){
            $dataItem->image="http://qbuy.lk/products/".$dataItem->image;

            $endDate=date_create($dataItem->end);
            $startDate=date_create($dataItem->start);

            $diff_current_end=date_diff($currentDate,$endDate);
            $diff_current_start=date_diff($startDate,$currentDate);

            #check active
            if($diff_current_start->format("%R%a")>=0 && $diff_current_end->format("%R%a")>=0){
                
                $dataItem->status=$status1;
                $finalData[]=$dataItem;
            }
            #check expird
            
            else if($diff_current_end->format("%R%a")<0){
                $dataItem->status=$status2;
            }
            
            #check schedule
            else if($diff_current_start->format("%R%a")<0){
                $dataItem->status=$status3;
                $finalData[]=$dataItem;
            }


        }

        return response()->json(['status'=>true,'data'=>$finalData,'message'=>"offers",'next'=>$next,'prew'=>$prew ]);
    }


}
