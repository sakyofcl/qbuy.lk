<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Lib\Common;

use App\model\user;
use App\model\user_token;
use App\model\user_profile;
use App\model\ship_address;
use App\model\cart;

class apiClientAuthController extends Controller
{
    public function clientRegister(Request $request){

        #validate input
        $validator=Validator::make($request->all(),[
            'phone'=>'required|max:10',
            'name'=>'required',
            'password'=>'required|min:8|max:15',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'data'=>[],'message'=>'plz ender data correct format.']);
        }

        if(user::where('phone',$request->phone)->exists()){
            return response()->json(['status'=>false,'data'=>[],'message'=>'This number already exists']);
        }
        

        $store = new user;
        $store->phone = $request->phone;
        $store->password = Hash::make($request->password);
        

        #temp set status active. and set verified 1 but we will check the verfify key on firebase and confirm it
        $store->status="restricted";
        $store->verified="0";

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
                $profile->contact=$request->phone;
                $profile->name=$request->name;
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
                        'verified'=>0
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
        

        /*
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
        */
       
    }
    public function clientLogin(Request $request){
        $validator=Validator::make($request->all(),[
            'phone'=>'required|max:10',
            'password'=>'required|min:8|max:15',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'data'=>[],'message'=>'plz ender data correct format.']);
        }

        if(user::where('phone',$request->phone)->exists()){
            $user = user::where(['phone' => $request->phone])->first();
        
            if($user){

            
                if (Hash::check($request->password, $user->password)) {
                    $token=user_token::where('uid',$user->uid)->first(['access_token']);
                    if($token){

                        return response()->json(
                            [
                                'status' => true,
                                'access_token' => $token->access_token,
                                'message' => "user successfully login",
                                'verified'=>(int)$user->verified
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
                else {
                    return response()->json(['status'=>false,'data'=>[],'message'=>'Wrong password.']);
                }
            }
          
        }
        else{
            return response()->json(['status'=>false,'data'=>[],'message'=>'Wrong phone number.']);
        }
    }


    public function checkNumberOrNot(Request $request){
        $validator=Validator::make($request->all(),[
            'phone'=>'required|max:10',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'data'=>[],'message'=>'plz put your phone number.']);
        }

        #check user number exist or not
        if(user::where('phone',$request->phone)->exists()){
            return response()->json(['status'=>false,'data'=>[],'message'=>'This number already exists']);
        }
        else{
            return response()->json(['status'=>true,'data'=>[],'message'=>'This nuumber is done']);
        }

    }



    
    public function forgotUserPassword(Request $request){
        $validator=Validator::make($request->all(),[
            'password'=>'required|min:8|max:15',
            'phone'=>'required|max:10',
            'verify_key'=>'required'
        ]);

        if($validator->fails()){
            return Common::json(false,[],"plz ender data correct format");
        }

        if(user::where('phone',$request->phone)->exists()){

            $user=user::where('phone',$request->phone)->first(['uid','verified']);

            $update = user::where('uid', $user->uid)->update(array(
                'password' => Hash::make($request->password)
            ));

            #get token
            $token=user_token::where('uid',$user->uid)->first(['access_token']);
            if($token){
                return response()->json(['status' => true,'access_token' => $token->access_token,'message' => "Password successfully forgot",'verified'=>(int)$user->verified]);
            }

            
        }
        else{
            return Common::json(false,[],"This number not exists..!");
        }

        
    }

 
}
