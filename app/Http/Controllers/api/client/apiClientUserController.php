<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Lib\Common;
use App\model\user;
use App\model\user_token;
use App\model\user_profile;
use App\model\ship_address;


class apiClientUserController extends Controller
{
    public function getUserProfile(Request $request){

        $userId=Common::getUserIdByToken($request->header('access_token'));

        #join date
        $joinDate=user::where('uid',$userId)->first(['date','verified','point']);

        #get user profile data
        $userProfileData=user_profile::where('uid',$userId)->first();

        #set user join date
        $userProfileData->date=$joinDate->date;

        #set user point
        $userProfileData->point=$joinDate->point;

        #set is user verified status;
        $userProfileData->verified=(int)$joinDate->verified;

        $userProfileData['image']="http://qbuy.lk/profile/{$userProfileData->image}";

        return Common::json(true,$userProfileData,"user profie");
            
    }


    public function updateUserProfile(Request $request){
        
        #user id
        $userId=Common::getUserIdByToken($request->header('access_token'));

        $update = user_profile::where('uid', $userId)->update(array(
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
        ));

        return Common::json(true,[],"profile updated!");

                     
    }

    public function updateUserProfileImage(Request $request){
        
        $userId=Common::getUserIdByToken($request->header('access_token'));

        $validator=Validator::make($request->all(),[
            'image'=>'required',
        ]);

        if($validator->fails()){
            return Common::json(false,[],"Profile image required.");
        }

        $profileData=user_profile::where('uid',$userId)->first(['image']);

        #check is default image and delete
        if($profileData->image!='user.jpg'){
            $imageName=$profileData->image;
            File::delete(public_path("profile/{$imageName}"));
        }


        $defaultImagePath=public_path('profile/make-image-from-uri.jpg');
        $storePath=public_path('profile');

        $deCode = base64_decode($request->image);        
        $profile = fopen($defaultImagePath, 'w');

        fwrite($profile, $deCode);

        #genarate file
        $filePath=pathinfo($defaultImagePath);
        $fileName=time().'.'.$filePath['extension'];

        #after genrate the name we copy file
        copy($defaultImagePath,$storePath.'/'.$fileName);
        
        fclose($profile);

        $update = user_profile::where('uid', $userId)->update(array(
            'image' => $fileName
        ));
        return Common::json(true,[],"Profile successfully updated..!");



    }


    public function getUserShipAddress(Request $request){
        
        $userId=Common::getUserIdByToken($request->header('access_token'));
        #get user profile data
        $userShipAddress=ship_address::where('uid',$userId)->get();

        if(isset($userShipAddress) && count($userShipAddress)>0){
            return Common::json(true,$userShipAddress,"user ship address"); 
        }
        else{
            return Common::json(true,[],"does not have data"); 
        }
                 
    }


    public function createUserShipAddress(Request $request){
        
        $userId=Common::getUserIdByToken($request->header('access_token'));
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
            return Common::json(true,[],"ship address created successfully"); 
        } else {
            return Common::json(false,[],"ship address not created , plz insert correct data!");
        }

    }


    public function updateUserShipAddress(Request $request)
    {
        
        #user id
        $userId=Common::getUserIdByToken($request->header('access_token'));
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

        return Common::json(true,[],"ship address updated successfully");
  
    }


    public function deleteUserShipAddress( Request $request){

        #get user profile data
        $addressId=$request->header('id');
        if($addressId){
            $delteAddres = ship_address::where('id', $addressId)->first();
            if ($delteAddres->delete()) {
                return Common::json(true,[],"ship address delete successfully");
            } else {
                return Common::json(false,[],"ship address not deleted");
            }
        }
        else{
            return Common::json(false,[],"ship address not mentioned");
        }

    }

    public function changeUserPassword(Request $request){
        $validator=Validator::make($request->all(),[
            'old'=>'required|min:8|max:15',
            'new'=>'required|min:8|max:15',
        ]);

        if($validator->fails()){
            return Common::json(false,[],"plz ender data correct format");
        }

        $userId=Common::getUserIdByToken($request->header('access_token'));
        $user=user::where('uid',$userId)->first(['password']);

        if(Hash::check($request->old, $user->password)){
            $update = user::where('uid', $userId)->update(array(
                'password' => Hash::make($request->new)
            ));
            return Common::json(true,[],"Pasword changed..!");
        }
        else{
            return Common::json(false,[],"Old password not matched..!");
        }


    }

    public function userAccountVerify(Request $request){
        $validator=Validator::make($request->all(),[
            'verify_key'=>'required',
        ]);

        if($validator->fails()){
            return Common::json(false,[],"The verify_key field is required.");
        }

        $userId=Common::getUserIdByToken($request->header('access_token'));

        $update = user::where('uid', $userId)->update(array(
            'verify_key' =>$request->verify_key,
            'verified'=>1,
            'status'=>'active'
        ));

        return response()->json(
            [
                'status' => true,
                'message' => "User successfully verified",
                'verified'=>1
            ]
        );


    }


     
}
