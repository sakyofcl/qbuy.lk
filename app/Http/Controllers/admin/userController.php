<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
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
            return back()->with(
                [
                    'message'=>"All fields are required",
                    'status'=>0
                ]
            );
        }

        
        if (user_profile::where('uid', $data->signature)->exists()) {
            $update = user_profile::where('uid',  $data->signature)->update(array(
                'name' => $data->name,
                'email' => $data->email,
                'gender' => $data->gender,
                'contact' => $data->phone,
            ));

            
            return back()->with(
                [
                    'message'=>"Successfully user profile updated.",
                    'status'=>1
                ]
            );
        } 
        else{
            return back()->with(
                [
                    'message'=>"This user profile doesn't exist.",
                    'status'=>2
                ]
            );
        }
    }

    public function changeUserPassword(Request $data){
        
        
        $validator=Validator::make($data->all(),[
            'signature'=>'required',
            'password'=>'required|min:8|max:15',
        ]);
        $error=$validator->errors();
        #return $error->first('password');

        if($validator->fails()){

            if($error->has('password') && $error->has('signature')){
                $passError=$error->first('password');
                $sigError=$error->first('signature');

                return back()->with(
                    [
                        'message'=>$passError." ".$sigError,
                        'status'=>0
                    ]
                );
            }
            else if($error->has('password')){
                $passError=$error->first('password');
                return back()->with(
                    [
                        'message'=>$passError,
                        'status'=>0
                    ]
                );
            }
            else if($error->has('signature')){
                $sigError=$error->first('signature');
                return back()->with(
                    [
                        'message'=>$sigError,
                        'status'=>0
                    ]
                );
            }

            return back();
        }

        

        if (user::where('uid', $data->signature)->exists()) {
            $update = user::where('uid',  $data->signature)->update(array(
                'password' => Hash::make($data->password),
            ));

            
            return back()->with(
                [
                    'message'=>"Successfully changed password.",
                    'status'=>1
                ]
            );
            
        } 
        else{
            
            return back()->with(
                [
                    'message'=>"This user doesn't exist.",
                    'status'=>2
                ]
            );
        }


    }


    public function deleteUser(Request $data){
        $validator=Validator::make($data->all(),[
            'signature'=>'required',
        ]);

        $error=$validator->errors();

        if($validator->fails()){

            if($error->has('signature')){
                $sigError=$error->first('signature');
                return back()->with(
                    [
                        'message'=>$sigError,
                        'status'=>0
                    ]
                );
            }

            
            return back();
        }

        if (user::where('uid', $data->signature)->exists()) {


            #delete user row
            user::where('uid',$data->signature)->delete();
            #delete user token
            user_token::where('uid',$data->signature)->delete();
            #delete profile row
            $getImage=user_profile::where('uid',$data->signature)->first(['image']);
            File::delete(public_path("profile/{$getImage->image}"));
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
            
            
            
            return back()->with(
                [
                    'message'=>"Successfully user deleted.",
                    'status'=>1
                ]
            );
        } 
        else{
            return back()->with(
                [
                    'message'=>"This user doesn't exist.",
                    'status'=>2
                ]
            );
        }
    }


    public function createUserAccount(Request $data){
                #validate input
        $validator=Validator::make($data->all(),[
            'phone'=>'required|max:10',
            'name'=>'required',
            'password'=>'required|min:8|max:15',
            'verify_key'=>'required',
        ]);
        if($validator->fails()){
            return back();
        }
        
        if(user::where('phone',$data->phone)->exists()){
            return back();
        }
    }
    
}
