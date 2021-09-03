<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\user;
use App\model\user_token;
use App\model\user_profile;
use App\model\ship_address;


class apiClientUserController extends Controller
{
    public function getUserProfile(Request $request){
        $userToken=$request->header('access_token');
        #return $request->header('access_token');
        if($userToken){
            #check token
            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;
                #get user profile data
                $userProfileData=user_profile::where('uid',$userId)->first();

                $deCode = base64_decode($userProfileData->image);        
                $profile = fopen(public_path('products/default/profile.jpg'), 'w');
                fwrite($profile, $deCode);
                fclose($profile);

                $userProfileData['image']="http://qbuy.lk/products/default/profile.jpg";
        
                return response()->json(['status'=>true,'data'=> $userProfileData,'message'=>"user profie"]);
            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"User not not found!"]);
            }
           
        }
        else{
            return response()->json(['status'=>false,'data'=>[],'message'=>"please put your signature"]);
        }
    }


    public function updateUserProfile(Request $request){
        
        #check token
        $userToken=$request->header('access_token');
        if($userToken){
            
            if(user_token::where('access_token',$userToken)->exists()){
                
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;

                $update = user_profile::where('uid', $userId)->update(array(
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                ));

                return response()->json(['status'=>true,'data'=>[],'message'=>"profile updated!"]);
            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"User not found!"]);
            }
        }
        else{
            return response()->json(['status'=>false,'data'=>[],'message'=>"please add signature"]);
        }


               
    }

    public function updateUserProfileImage(Request $request){
        #check token
        $userToken=$request->header('access_token');
        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;

                if($request->image){
                    $update = user_profile::where('uid', $userId)->update(array(
                        'image' => $request->image
                    ));
    
                    return response()->json(['status'=>true,'data'=>[],'message'=>"Profile successfully updated..!"]);
                }
                else{
                    return response()->json(['status'=>false,'data'=>[],'message'=>"Plz select image"]);
                }


            }
            else{
                return response()->json(['status'=>false,'data'=>[],'message'=>"User not found!"]);
            }

        }
        else{
            return response()->json(['status'=>false,'data'=>[],'message'=>"please add signature"]);
        }

    }


    public function getUserShipAddress(Request $request){
        $userToken=$request->header('access_token');
        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;
                #get user profile data
                $userShipAddress=ship_address::where('uid',$userId)->get();
                if(isset($userShipAddress) && count($userShipAddress)>0){
                    return response()->json(['status'=>true,'data'=> $userShipAddress,'message'=>"user ship address"]);
                }
                else{
                    return response()->json(["status"=>true,"data"=> [],"message"=>"does not have data"]);
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


    public function createUserShipAddress(Request $request){
        
        $userToken=$request->header('access_token');
        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;
                #get user profile data

                $store = new ship_address;
                $store->name = $request->name;
                $store->street = $request->street;
                $store->city = $request->city;
                $store->province = $request->province;
                $store->zip = $request->zip;
                $store->contact = $request->contact;
                $store->uid =$userId;

                if ($store->save()) {
                    return response()->json(["status"=>true,"data"=>[],"message"=>"ship address created successfully"]);
                } else {
                    return response()->json(["status"=>false,"data"=>[],"message"=>"ship address not created , plz insert correct data!"]);
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


    public function updateUserShipAddress(Request $request)
    {
        $userToken=$request->header('access_token');
        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;
                #get user profile data

                ship_address::where('id', $request->id)->update(array(
                    'name' => $request->name,
                    'street' => $request->street,
                    'city' => $request->city,
                    'province' => $request->province,
                    'zip' => $request->zip,
                    'contact' => $request->contact,
                    'uid' => $userId
                ));
                return response()->json(["status"=>true,"data"=>[],"message"=>"ship address updated successfully"]);

            }
            else{
                return response()->json(["status"=>false,"data"=>[],"message"=>"User not found!"]);
            }
        }
        else{
            return response()->json(["status"=>false,"data"=>[],"message"=>"please add signature"]);
        }
    }


    public function deleteUserShipAddress( Request $request){
        $userToken=$request->header('access_token');
        $addressId=$request->header('id');
        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){
                #get uid from token
                $user=user_token::where('access_token',$userToken)->first();
                #user id
                $userId=$user->uid;
                #get user profile data

                $delteAddres = ship_address::where('id', $addressId)->first();
                if ($delteAddres->delete()) {
                    return response()->json(["status"=>true,"data"=>[],"message"=>"ship address delete successfully"]);
                    
                } else {
                    return response()->json(["status"=>false,"data"=>[],"message"=>"ship address not deleted "]);
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
