<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\user_token;
use App\model\cart;
use App\model\cart_item;
use App\model\product;
use App\model\user;
use App\model\offer;
use App\model\offer_cart_item;
class apiClientCartController extends Controller
{
    public function getCart(Request $request){
        #check token
        $userToken=$request->header('access_token');
        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){


                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;

                
                if(cart::where('uid',$userId)->exists()){
                    #get cart id
                    $cart=cart::where('uid',$userId)->first();
                    $cart_id=$cart->cart_id;

                    $cartItem = cart_item::where('cart_id',$cart_id)->orderBy('date', 'DESC')->get();
                    $offerCart=offer_cart_item::where('cart_id',$cart_id)->orderBy('date', 'DESC')->get();

                    $cartDataList = [];
                    $total=0;
                    if($cartItem!=null && count($cartItem)>0){
                        
                        
                        foreach ($cartItem as $cartItemData) {
                            
                            $product = product::where('pid', $cartItemData['pid'])->first(['name', 'price', 'image']);
                            if($product!=null){
                                $cartDataList[] = [
                                    'cart_item_id' =>$cartItemData['cart_item_id'],
                                    'pid' => $cartItemData['pid'],
                                    'name' => $product->name,
                                    'price' => $product->price,
                                    'image'=>"http://qbuy.lk/products/".$product->image,
                                    'qty' =>$cartItemData['qty'],
                                    'offer'=>0,
                                    'offer_price'=>0,
                                    'offer_cart_id'=>0
                                ];
                                if($cartItemData['qty']<=0){
                                    $total=$total+($product->price*1);
                                }
                                else{
                                    $total=$total+($product->price*$cartItemData['qty']);
                                }
                                
                            }
                        
                        
                        }
                        #return response()->json(['status'=>true,'data'=>$cartDataList,'message'=>"user carts..!",'total'=>$total]);
                    }

                    if($offerCart!=null && count($offerCart)>0){
                        foreach ($offerCart as $offerCartData) {
                            $offerData=offer::where('offer_id',$offerCartData['offer'])->first(['pid', 'offer_price']);
                            
                            $product = product::where('pid',$offerData->pid)->first(['name', 'price', 'image','pid']);
                            if($product!=null){
                                $cartDataList[] = [
                                    'cart_item_id' =>0,
                                    'pid' =>$product->pid,
                                    'name' => $product->name,
                                    'price' => $product->price,
                                    'image'=>"http://qbuy.lk/products/".$product->image,
                                    'qty' =>$offerCartData['qty'],
                                    'offer_price'=>$offerData->offer_price,
                                    'offer'=>$offerCartData['offer'],
                                    'offer_cart_id'=>$offerCartData['offer_cart_id']
                                    
                                ];
                                if($offerCartData['qty']<=0){
                                    $total=$total+($offerData->offer_price*1);
                                }
                                else{
                                    $total=$total+($offerData->offer_price*$offerCartData['qty']);
                                }
                                
                            }
                        
                        
                        }
                    }

                    return response()->json(['status'=>true,'data'=>$cartDataList,'message'=>"cart..!",'total'=>$total]);
                    
                    if(($offerCart!=null && count($offerCart)>0) && ($cartItem!=null && count($cartItem)>0)){
                        return response()->json(['status'=>true,'data'=>$cartDataList,'message'=>"cart..!",'total'=>$total]);
                    }
                    else{
                        return response()->json(['status'=>false,'data'=>[],'message'=>"nothing cart..!"]);
                    }
                    

                }else{
                    return response()->json(['status'=>false,'data'=>[],'message'=>"user cart not create..!"]);
                }

            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"User not found!"]);
            }

        }
        else{
            return response()->json(["status"=>false,"data"=>[],"message"=>"please add signature"]);
        }
    }


    public function addCart(Request $request){
        #check token
        $userToken=$request->header('access_token');
        $pid=$request->header('pid');
        $qty=$request->header('qty');
        $offer=$request->header('offer');
        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;

                if(cart::where('uid',$userId)->exists()){

                    if($offer && $qty){
                        if(offer::where('offer_id',$offer)->exists()){
                            #get cart_id;
                            $cart=cart::where('uid',$userId)->first();
                            $cart_id=$cart->cart_id;

                            if(offer_cart_item::where([['offer','=',$offer],['cart_id','=',$cart_id]])->exists()){
                                return response()->json(['status'=>false,'data'=>[],'message'=>"Product already in cart..!"]);
                            }
                            else{
                                if($qty>0){
                                    
                                    $store=new offer_cart_item;
                                    $store->offer=$offer;
                                    $store->qty=$qty;
                                    $store->cart_id=$cart_id;
        
                                    if($store->save()){
                                        return response()->json(['status'=>true,'data'=>[],'message'=>"Cart added successfully..!"]);
                                    }
                                    else{
                                        return response()->json(['status'=>false,'data'=>[],'message'=>"Cart not added"]);
                                    }
                                    
                                }
                                else{
                                    return response()->json(['status'=>false,'data'=>[],'message'=>"Qty not less then 1"]);
                                }

                            }

                            
                            
                        }
                        else{
                            return response()->json(['status'=>false,'data'=>[],'message'=>"This product not in offer..!"]);
                        }
                    }

                    else if($pid && $qty){
                        if(product::where('pid',$pid)->exists()){
                            #get cart_id;
                            $cart=cart::where('uid',$userId)->first();
                            $cart_id=$cart->cart_id;

                            if(cart_item::where([['pid','=',$pid],['cart_id','=',$cart_id]])->exists()){
                                return response()->json(['status'=>false,'data'=>[],'message'=>"Product already in cart..!"]);
                            }
                            else{
                                if($qty>0){
                                    
                                    $store=new cart_item;
                                    $store->pid=$pid;
                                    $store->qty=$qty;
                                    $store->cart_id=$cart_id;
        
                                    if($store->save()){
                                        return response()->json(['status'=>true,'data'=>[],'message'=>"Cart added successfully..!"]);
                                    }
                                    else{
                                        return response()->json(['status'=>false,'data'=>[],'message'=>"Cart not added"]);
                                    }
                                    
                                }
                                else{
                                    return response()->json(['status'=>false,'data'=>[],'message'=>"Qty not less then 1"]);
                                }

                            }

                            
                            
                        }
                        else{
                            return response()->json(['status'=>false,'data'=>[],'message'=>"This product not exists..!"]);
                        }
                    }
                    
                    else{
                        return response()->json(['status'=>false,'data'=>[],'message'=>"Header credentials missing...!"]);
                    }
                }
                else{
                    return response()->json(["status"=>false,"data"=>[],"message"=>"User not found!"]);
                }
            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"User not found!"]);
            }
        }
        else{
            return response()->json(["status"=>false,"data"=>[],"message"=>"please add signature"]);
        }
    }


    public function deleteCart(Request $request){
        #check token
        $userToken=$request->header('access_token');
        $cart_item_id=$request->header('cart');
        $offer=$request->header('offer');

        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;

                if(cart::where('uid',$userId)->exists()){
                    #get cart_id;
                    $cart=cart::where('uid',$userId)->first();
                    $cart_id=$cart->cart_id;

                    if($cart_item_id){

                        if(cart_item::where([['cart_item_id','=',$cart_item_id],['cart_id','=',$cart_id]])->exists()){
                            $deleteCart=cart_item::where('cart_item_id',$cart_item_id)->first();

                            $deleteCart->delete();
                            return response()->json(['status'=>true,'data'=>[],'message'=>"cart deleted.."]);
                        }
                        else{
                            return response()->json(['status'=>false,'data'=>[],'message'=>"This is not your cart..!"]);
                        }
                    }
                    else if($offer){

                        if(offer_cart_item::where([['offer_cart_id','=',$offer],['cart_id','=',$cart_id]])->exists()){
                            $deleteCart=offer_cart_item::where('offer_cart_id',$offer)->first();

                            $deleteCart->delete();
                            return response()->json(['status'=>true,'data'=>[],'message'=>"cart deleted.."]);
                        }
                        else{
                            return response()->json(['status'=>false,'data'=>[],'message'=>"This is not your cart..!"]);
                        }

                    }
                    else{
                        return response()->json(['status'=>false,'data'=>[],'message'=>"Header credentials missing...!"]);
                    }
                }
                else{
                    return response()->json(["status"=>false,"data"=>[],"message"=>"User not found!"]);
                }
            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"User not found!"]);
            }

        }
        else{
            return response()->json(["status"=>false,"data"=>[],"message"=>"please add signature"]);
        }

    }


    public function qtyUpdate(Request $request){
        #check token
        $userToken=$request->header('access_token');
        $cart_item_id=$request->header('cart');
        $qty=$request->header('qty');
        $offer=$request->header('offer');

        if($userToken){

            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;
                
                if(user::where('uid',$userId)->exists()){
                    if($offer && $qty){
                        if(cart::where('uid',$userId)->exists()){

                            #get cart_id;
                            $cart=cart::where('uid',$userId)->first();
                            $cart_id=$cart->cart_id;
        
                            if(offer_cart_item::where([['offer_cart_id','=',$offer],['cart_id','=',$cart_id]])->exists()){

                                if($qty>0){
                                    
                                    
                                    $cartItem=offer_cart_item::where('offer_cart_id',$offer)->first(['offer']);
                                    $offerItem=$cartItem->offer;
                                    
                                    $offerDataItem=offer::where('offer_id',$offerItem)->first(['pid']);
                                    $product=product::where('pid',$offerDataItem->pid)->first(['stock']);
                                    
                                    
                                    if($product){
                                        $stock=$product->stock;

                                        if($qty<=$stock){
                                            offer_cart_item::where('offer_cart_id', $offer)->update(array(
                                                'qty' =>$qty
                                            ));

                                            return response()->json(['status'=>true,'data'=>[],'message'=>"Cart updated successfully..!"]);
                                        }
                                        else{
                                            return response()->json(['status'=>false,'data'=>[],'message'=>"Stock not available..!"]);
                                        }
                                        
                                    }
                                    else{
                                        return response()->json(['status'=>false,'data'=>[],'message'=>"unexpected product not found..!"]);
                                    }
                                    
            
                                    
                                }
                                else{
                                    return response()->json(['status'=>false,'data'=>[],'message'=>"Qty not less then 1"]);
                                }
        
                                
                            }
                            else{
                                return response()->json(['status'=>false,'data'=>[],'message'=>"This is not your cart..!"]);
                            }
        
                        }
                    }
                    else if($cart_item_id && $qty){
                        if(cart::where('uid',$userId)->exists()){

                            #get cart_id;
                            $cart=cart::where('uid',$userId)->first();
                            $cart_id=$cart->cart_id;
        
                            if(cart_item::where([['cart_item_id','=',$cart_item_id],['cart_id','=',$cart_id]])->exists()){

                                if($qty>0){
                                    

                                    $cartItem=cart_item::where('cart_item_id',$cart_item_id)->first(['pid']);
                                    $product=product::where('pid',$cartItem->pid)->first(['stock']);
                                    
                                    
                                    if($product){
                                        $stock=$product->stock;

                                        if($qty<=$stock){
                                            cart_item::where('cart_item_id', $cart_item_id)->update(array(
                                                'qty' =>$qty
                                            ));

                                            return response()->json(['status'=>true,'data'=>[],'message'=>"Cart updated successfully..!"]);
                                        }
                                        else{
                                            return response()->json(['status'=>false,'data'=>[],'message'=>"Stock not available..!"]);
                                        }
                                        
                                    }
                                    else{
                                        return response()->json(['status'=>false,'data'=>[],'message'=>"unexpected product not found..!"]);
                                    }
                                    
            
                                    
                                }
                                else{
                                    return response()->json(['status'=>false,'data'=>[],'message'=>"Qty not less then 1"]);
                                }
        
                                
                            }
                            else{
                                return response()->json(['status'=>false,'data'=>[],'message'=>"This is not your cart..!"]);
                            }
        
                        }
                    }
                    else{
                        return response()->json(['status'=>false,'data'=>[],'message'=>"Header credentials missing...!"]);
                    }

                    
                    
                }
                else{
                    return response()->json(["status"=>false,"data"=>[],"message"=>"User not found!"]);
                }
            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"User not found!"]);
            }

        }
        else{
            return response()->json(["status"=>false,"data"=>[],"message"=>"please add signature"]);
        }
    }



}
