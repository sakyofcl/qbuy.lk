<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\model\order;
use App\model\order_stage;
use App\model\ship_address;
use App\model\user;
use App\model\product;
use App\model\order_product;
use App\model\user_token;
use App\model\payment_method;
use App\model\offer;



class apiClientOrderController extends Controller
{
    public function userPlaceOrder(Request $request){
        #return response()->json(['data type'=>gettype($request->product),'content type'=>$request->header("Content-type"),'data'=>$request->product]);
        $userToken=$request->header('access_token');
        if($userToken){
            
            if(user_token::where('access_token',$userToken)->exists()){

                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;
                #get user profile data

                $address=$request->address;
                $payment=$request->payment;
                $productData=$request->product;

                if($address){
                    if(ship_address::where('id',$address)->exists()){
                        if(payment_method::where('payment',$payment)->exists()){

                            if($productData){

                                $store=new order;
                                $store->uid=$userId;
                                $store->payment=$payment;
                                $store->address_id=$address;
                                if($store->save()){
                                    $orderStage = new order_stage;

                                    #get order id
                                    $oid = order::orderBy('oid', 'DESC')->first('oid');
                                    #order product

                                    #order stage
                                    $orderStage->stage = "new";
                                    $orderStage->oid = $oid->oid;
                                    $orderStage->save();


                                    #order product
                                    $orderProductData = [];
                                    foreach ($productData as $item) {

                                        if(array_key_exists('offer',$item)){
                                            $offer=$item['offer'];
                                            if(offer::where('offer_id',$offer)->exists()){
                                                
                                                $offerData=DB::table('offers')
                                                    ->select(['products.pid','products.name','offers.offer_price','offers.start','offers.end'])
                                                    ->join('products','offers.pid','=','products.pid')
                                                    ->where('offers.offer_id','=',$offer)
                                                    ->first();
                                                
                                                if($offerData){
                                                    
                                                    $currentDate=date_create(date('Y-m-d'));
                                                    $endDate=date_create($offerData->end);
                                                    $startDate=date_create($offerData->start);
                                        
                                                    $diff_current_end=date_diff($currentDate,$endDate);
                                                    $diff_current_start=date_diff($startDate,$currentDate);
                                        
                                                    #check offer is active?
                                                    if($diff_current_start->format("%R%a")>=0 && $diff_current_end->format("%R%a")>=0){
                                                        $orderProductData[] = [
                                                            'oid' => $oid->oid,
                                                            'pid' => $offerData->pid,
                                                            'name' => $offerData->name,
                                                            'price' => $offerData->offer_price,
                                                            'qty' => $item['qty']
                                                        ];
                                                    }

                                                }
                                            
                                            }
                                            
                                        }
                                        else {
                                            $product = product::where('pid', $item['pid'])->first(['pid', 'name', 'price']);
                                            if($product!=null){
                                                $orderProductData[] = [
                                                    'oid' => $oid->oid,
                                                    'pid' => $product->pid,
                                                    'name' => $product->name,
                                                    'price' => $product->price,
                                                    'qty' => $item['qty']
                                                ];
                                            }
                                        }

                                        
                                    }

                                    DB::table('order_products')->insert($orderProductData);

                                    return response()->json(["status"=>true,"data"=>[],"message"=>"Order successfully placed",'oreder'=>$oid->oid]);
                                }
                                else{
                                    return response()->json(["status"=>false,"data"=>[],"message"=>"Somthiing wrong"]);
                                }

                            }
                            else{
                                return response()->json(["status"=>false,"data"=>[],"message"=>"no product was selected..!"]);
                            }
                            
                            
                        }
                        else{
                            return response()->json(["status"=>false,"data"=>[],"message"=>"plz select payment method"]);
                        }
                    }
                    else{
                        return response()->json(["status"=>false,"data"=>[],"message"=>"ship address not found"]);
                    }
                }else{
                    return response()->json(["status"=>false,"data"=>[],"message"=>"give your address before order"]);
                }          

            }
            else{
                return response()->json(["status"=>false,"data"=>[],"message"=>"User not found!"]);
            }
        }
        else{
            return response()->json(["status"=>false,"data"=>[],"message"=>"please add signature"]);
        }
    }


    public function getPlaceOrder(Request $request){
        $userToken=$request->header('access_token');
        $orderStatus=$request->header('status');

        if($userToken){
            
            if(user_token::where('access_token',$userToken)->exists()){

                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;
                #get user profile data


                #get order by status
                $status="all"; 
                if($orderStatus){
                    if($orderStatus=="wait"){
                        $status="wait";
                    }
                    else{
                        $status="all"; 
                    }
                }


                if($status=="wait"){
                    $status1='pending';
                    $status2='process';
                    $status3='couriered';
                    $orederData=DB::table('orders')
                    ->select(
                        [
                            'products.name',
                            'products.price',
                            'order_products.qty',
                            'orders.oid',
                            'orders.status',
                            'orders.date',
    
                        ]
                    )
                    ->join('order_products','orders.oid','=','order_products.oid')
                    ->join('products','order_products.pid',"=","products.pid")
                    ->where(['orders.uid' =>$userId])
                    ->where('orders.status',$status1)
                    ->orWhere('orders.status',$status2)
                    ->orWhere('orders.status',$status3)
                    ->orderBy('orders.date','DESC')
                    ->get();
                }
                else{
                   
                    $status1='complete';
                    $status2='cancelled';

                    $orederData=DB::table('orders')
                    ->select(
                        [
                            'products.name',
                            'products.price',
                            'order_products.qty',
                            'orders.oid',
                            'orders.status',
                            'orders.date',
    
                        ]
                    )
                    ->join('order_products','orders.oid','=','order_products.oid')
                    ->join('products','order_products.pid',"=","products.pid")
                    ->where(['orders.uid' =>$userId])
                    ->where('orders.status',$status1)
                    ->orWhere('orders.status',$status2)
                    ->orderBy('orders.date','DESC')
                    ->get();
                }




                $newArray=['result'=>[]];

               
                for ($i=0;$i<count($orederData);$i++){
                    
                    $machedIndex=false;
                    for($j=0;$j<count($newArray['result']);$j++){
                        if($newArray['result'][$j]["OrderId"]==$orederData[$i]->oid){
                            $newArray['result'][$j]["total"]=$newArray['result'][$j]["total"]+(int)$orederData[$i]->price*(int)$orederData[$i]->qty;
                            
                            $newArray['result'][$j]["OrderData"][]=$orederData[$i];
                            $machedIndex=true;
                           
                        }
                        else{
                            $machedIndex=false;
                        }
                    }
                    if(!$machedIndex){
                        $newArray['result'][]=[
                            'OrderId'=>$orederData[$i]->oid,
                            'date'=>$orederData[$i]->date,
                            'total'=>(int)$orederData[$i]->price*(int)$orederData[$i]->qty,
                            'status'=>$orederData[$i]->status,
                            'OrderData'=>[$orederData[$i]]
                            
                        ];
                    }

                }

                
                return response()->json(["status"=>true,"data"=>$newArray,"message"=>"User orders"]);

            }
            else{
                return response()->json(["status"=>false,"data"=>[],"message"=>"User not found!"]);
            }
        }
        else{
            return response()->json(["status"=>false,"data"=>[],"message"=>"please add signature"]);
        }

    }
}
