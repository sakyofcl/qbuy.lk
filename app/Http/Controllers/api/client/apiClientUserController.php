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
                    'contact' => $request->contact,
                    'image'=>base64_encode(file_get_contents($request->file('image')))
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
}
