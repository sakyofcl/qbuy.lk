<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\model\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\model\product;
use App\model\product_stock_status;
use App\model\user_token;
use App\model\view_log;

class apiProductController extends Controller
{
    public function storeProduct(Request $data)
    {

        $validator=Validator::make($data->all(),[
            'image'=>'required',
            'cid'=>'required',
            'name'=>'required',
        ]);

        if($validator->fails()){
            return response()->json(['message' => "Name,category,image are required", 'status' =>300]);
        }



        $store = new product;
        

        $store->cid = $data->cid;

        $store->name = $data->name;
        #final string;
        $ask=" ";
        #explode word by " "
        $word=explode(" ", $data->name);

        foreach($word as $wordItem){
            $ask.=metaphone($wordItem)." ";
        }

        $store->key_tag=$ask;

        if($data->price){
            $store->price = $data->price;
        }
        if($data->description){
            $store->description = $data->description;
        }
        if($data->stock){
            $store->stock = $data->stock;
        }
        if($data->unitWeight){
            $store->unit_weight = $data->unitWeight;
        }
        if($data->unit){
            $store->unit = $data->unit;
        }
       
        

        # store main image
        $image = $data->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $storepath = public_path('./products');
        $image->move($storepath,  $imageName);
        $store->image = $imageName;



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
            $data=DB::table('products')
                ->select(['*'])
                ->orderByRaw('RAND()')
                ->where('products.cid','=',$cat_Id)
                ->paginate(20);
            
            #$data=product::where('cid',$cat_Id)->order->get();

            if(isset($data) && count($data)>0){
            
                foreach($data as $dataItem){
                    #cast int 
                    $dataItem->pid=(int)$dataItem->pid;
                    $dataItem->price=(int)$dataItem->price;
                    $dataItem->stock=(int)$dataItem->stock;
                    $dataItem->sold_count=(int)$dataItem->sold_count;
                    $dataItem->unit_weight=(int)$dataItem->unit_weight;
                    $dataItem->cid=(int)$dataItem->cid;
                    
                    $dataItem->image="http://qbuy.lk/products/".$dataItem->image;
                }

                $next=false;
                if($data->nextPageUrl()){
                    $next=$data->nextPageUrl();
                }
                else{
                    $next=false;
                }
    
                return response()->json([
                    'status'=>true,
                    'data'=>$data->items(),
                    'message'=>"get product successfully..!",
                    'next'=>$next
                ]);
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

                        #typecasete
            $dataItem->pid=(int)$dataItem->pid;
            $dataItem->price=(int)$dataItem->price;
            $dataItem->stock=(int)$dataItem->stock;
            $dataItem->sold_count=(int)$dataItem->sold_count;
            $dataItem->unit_weight=(int)$dataItem->unit_weight;
            $dataItem->cid=(int)$dataItem->cid;
            $dataItem->offer_id=(int)$dataItem->offer_id;
            $dataItem->offer_price=(int)$dataItem->offer_price;

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


    public function getTrendingProducts(Request $request){


        $trendingItems=[];

        $data=DB::table('view_logs')
        ->select(
            [
               "view_logs.item"
            ]
        )
        ->groupBy('view_logs.item')
        ->whereRaw('TIMESTAMPDIFF(DAY,view_logs.date,NOW())=0')
        ->orderByRaw('COUNT(view_logs.item) DESC')
        ->take(20)
        ->get();

        foreach($data as $dataItem){
            $item=product::where('pid',$dataItem->item)->first();
            if($item){
                $item->image="http://qbuy.lk/products/".$item->image;
                $trendingItems[]=$item;
            }        
        }

        return response()->json(['status'=>true,'data'=>$trendingItems,'message'=>"Trending products..!"]);
    }

    public function getMostLovedProducts(Request $request){
        $mostLovedItem=[];
        $data=DB::table('view_logs')
                ->select(
                    [
                       "view_logs.item"
                    ]
                )
                ->groupBy('view_logs.item')
                ->orderByRaw('COUNT(view_logs.item) DESC')
                ->take(20)
                ->get();

        foreach($data as $dataItem){
            $item=product::where('pid',$dataItem->item)->first();
            if($item){
                $item->image="http://qbuy.lk/products/".$item->image;
                $mostLovedItem[]=$item;
            }        
        }

        return response()->json(['status'=>true,'data'=>$mostLovedItem,'message'=>"Most loved products..!"]);
    }

    public function storeProductViewedInformation(Request $request){
        $store=new view_log;

        if($request->item){
            
            $item=$request->item;
            if(product::where('pid',$item)->exists()){
                $userToken=$request->access_token;
                if($userToken){
                    if(user_token::where('access_token',$userToken)->exists()){
                        #get uid from token
                        $user=user_token::where('access_token',$userToken)->first();
                        #user id
                        $userId=$user->uid;

                        if(view_log::where(['uid'=>$userId,'item'=>$item])->exists()){
                            return response()->json(['status'=>true,'data'=>[],'message'=>"product already viewed..!"]);
                        }
                        else{
                            $store->item=$item;
                            $store->uid=$userId;   
                            
                            if($store->save()){
                                return response()->json(['status'=>true,'data'=>[],'message'=>"product viewed..!"]);
                            }
                        }
                        
                    }
                }
                else{
                    $store->item=$item;
                    if($store->save()){
                        return response()->json(['status'=>true,'data'=>[],'message'=>"product viewed by unknown..!"]);
                    }
                }


            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"product not found"]);
            }
            
        }
        else{
            return response()->json(['status'=>false,'data'=>[],'message'=>"product not viewed"]);
        }
    }


    public function getTopCategory(){
        
        $data=DB::table('view_logs')
                ->select(
                    [
                       "products.cid"
                    ]
                )
                ->join('products','products.pid','=','view_logs.item')
                ->groupBy('products.cid')
                ->orderByRaw('COUNT(products.cid) DESC')
                ->take(5)
                ->get();
        foreach($data as $dataItem){
            $cat=category::where('cid',$dataItem->cid)->first(['name']);
            if($cat){
                $dataItem->name=$cat->name;
            }
            else{
                $dataItem->name=false;
            }
            
        }
            
        return response()->json(['status'=>true,'data'=>$data,'message'=>"Top 5 category"]);  
    }

}
