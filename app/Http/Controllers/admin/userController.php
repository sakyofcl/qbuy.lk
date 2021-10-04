<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


use App\model\user_profile;
use App\model\user;
use App\model\user_token;
use App\model\ship_address;
use App\model\cart;
use App\model\cart_item;

class userController extends Controller
{
    public function user(){
        $data=DB::table('users')
        ->select(
            [
                'users.uid',
                'users.phone',
                'user_profiles.name',
                'user_profiles.image',
                'users.level',
                'users.status',
                'user_tokens.access_token',
            ]
        )
        ->join('user_profiles','users.uid','=','user_profiles.uid')
        ->join('user_tokens','users.uid','=','user_tokens.uid')
        ->paginate(10);
        return view('admin/user/user',['users'=>$data]);
    }
    public function userInfo(Request $request){
        if($request->uid){
            $data=DB::table('users')
            ->select(
                [
                    'users.uid',
                    'users.phone',
                    'user_profiles.name',
                    'user_profiles.image',
                    'user_profiles.email',
                    'user_profiles.gender',
                    'users.date',
                    'users.status',
                    'users.level'
                ]
            )
            ->join('user_profiles','users.uid','=','user_profiles.uid')
            ->where('users.uid',$request->uid)
            ->first();
            return view('admin/user/user-info',['user'=>$data]);
        }
        else{
            return back();
        }
        
    }

    public function editUserProfile(Request $data){

        $validator=Validator::make($data->all(),[
            'signature'=>'required',
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required|max:10',
            'gender'=>'required'
        ]);

        if($validator->fails()){
            return back();
        }

        
        if (user_profile::where('uid', $data->signature)->exists()) {
            $update = user_profile::where('uid',  $data->signature)->update(array(
                'name' => $data->name,
                'email' => $data->email,
                'gender' => $data->gender,
                'contact' => $data->phone,
            ));

            return back();
        } 
        else{
            return back();
        }
    }

    public function changeUserPassword(Request $data){
        
        
        $validator=Validator::make($data->all(),[
            'signature'=>'required',
            'password'=>'required|min:8|max:15',
        ]);

        if($validator->fails()){
            return back();
        }

        

        if (user::where('uid', $data->signature)->exists()) {
            $update = user::where('uid',  $data->signature)->update(array(
                'password' => Hash::make($data->password),
            ));

            return back();
        } 
        else{
            return back();
        }


    }


    public function deleteUser(Request $data){
        $validator=Validator::make($data->all(),[
            'signature'=>'required',
        ]);

        if($validator->fails()){
            return back();
        }

        if (user::where('uid', $data->signature)->exists()) {


            #delete user row
            user::where('uid',$data->signature)->delete();
            #delete user token
            user_token::where('uid',$data->signature)->delete();
            #delete profile row
            user_profile::where('uid',$data->signature)->delete();
            #delete ship address
            if(ship_address::where('uid', $data->signature)->exists()){
                $delData=ship_address::where('uid', $data->signature)->get();
                foreach ($delData as $delDataItem) {
                    $delDataItem->delete();
                }
                
            }

            #delete user cart
            if(cart::where('uid', $data->signature)->exists()){
                $delCart=cart::where('uid', $data->signature)->first();
                $cart_id=$delCart->cart_id;

                $delCart->delete();


                if(cart_item::where('cart_id', $cart_id)->exists()){
                    $delCartItem=cart_item::where('cart_id', $cart_id)->get();
                    foreach ($delCartItem as $delCartItemData) {
                        $delCartItemData->delete();
                    }
                    
                }


            }
            
            
            
            return back();
        } 
        else{
            return back();
        }
    }
    
}
