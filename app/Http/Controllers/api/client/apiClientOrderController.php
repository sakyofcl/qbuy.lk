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


class apiClientOrderController extends Controller
{
    public function userPlaceOrder(Request $request){
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

                                    DB::table('order_products')->insert($orderProductData);

                                    return response()->json(["status"=>true,"data"=>[],"message"=>"Order successfully placed"]);
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
}
