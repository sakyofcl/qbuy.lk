<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\model\user;
use App\model\user_token;
use App\model\user_profile;
use App\model\ship_address;
use App\model\cart;

class apiClientAuthController extends Controller
{
    public function clientRegister(Request $request){

        
        


        if(user::where('phone',$request->phone)->exists()){
            $client = user::where(['phone' =>$request->phone])->first();
        
            if ($client) {
                $token=user_token::where('uid',$client->uid)->first(['access_token']);
                if($token){
                    return response()->json(
                        [
                            'status' => true,
                            'access_token' => $token->access_token,
                            'message' => "user successfully login"
                        ]
                    );
                }
                 else{
                    return response()->json(
                        [
                            'status' => false,
                            'access_token' => "",
                            'message' => "verify your account!"
                        ]
                    ); 
                }
            }

            
        }
        else{
            
            $store = new user;
            $store->phone = $request->phone;
            #$store->password = Hash::make($request->password);
            $store->verify_key=$request->verify_key;

            #check verify key
            #...check ferify into firbase;

            if ($store->save()) {
                $uid = user::orderBy('uid', 'DESC')->first('uid');
                $token = new user_token;
                $token->uid = $uid->uid;
                #generate token
                $access_token = Str::random(60);
                #store token
                $token->access_token =$access_token;

                if ($token->save()) {
                    
                    #create user profile
                    $profile=new user_profile;
                    $profile->uid=$uid->uid;
                    $defaultImage = public_path('assets/Backend/img/default/user.png');
                    $image=base64_encode(file_get_contents($defaultImage));      
                    $profile->image=$image;
                    $profile->contact=$request->phone;
                    $profile->save();

                    #initiate cart
                    $cart=new cart;
                    $cart->uid=$uid->uid;
                    $cart->save();

                    return response()->json(
                        [
                            'status' => true,
                            'access_token' => $access_token,
                            'message' => "User successfully register",
                            "test"=>$uid->uid
                        ]
                    );
                }
            } 

            else {
                    return response()->json(
                        [
                            'status' => false,
                            'access_token' => "",
                            'message' => "Ender details correctly"
                        ]
                    );
            }
            

        }
       
    }
    public function clientLogin(Request $request){
     
    }
}
