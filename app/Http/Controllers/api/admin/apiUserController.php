<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\model\user;
use App\model\user_token;
use App\model\user_profile;
use App\model\ship_address;

class apiUserController extends Controller
{
    public function storeUser(Request $data)
    {

        $store = new user;
        $store->phone = $data->phone;
        $store->password = Hash::make($data->password);

        if(user::where('phone', $data->phone)->exists()){

        }
        else{
            if ($store->save()) {
                $uid = user::orderBy('uid', 'DESC')->first('uid');
                $token = new user_token;
                $token->uid = $uid->uid;
                #generate token
                $access_token = Str::random(60);
                $refresh_token = Str::random(60);
    
                $token->access_token = hash('sha256', $access_token);
                $token->refresh_token = hash('sha256', $refresh_token);
    
                if ($token->save()) {
                    $user_token = user_token::where('uid', $uid->uid)->first(['access_token', 'refresh_token', 'uid']);
                    return response()->json(['access_token' => $user_token->access_token, 'refresh_token' => $user_token->refresh_token, 'signature' => $user_token->uid], 200);
                }
            } else {
                return response()->json(['status' => '400', 'message' => 'ender details correctly']);
            }
        }
       
    }

    

    public function updateProfile(Request $data)
    {

        #check token
        $check = user_token::where(
            [
                'access_token' => $data->header('access_token'),
                'refresh_token' => $data->header('refresh_token'),
                'uid' => $data->header('signature')
            ]
        )->exists();

        if ($check) {
            if (user_profile::where('uid', $data->header('signature'))->exists()) {
                $update = user_profile::where('uid', $data->header('signature'))->update(array(
                    'name' => $data->name,
                    'email' => $data->email,
                    'gender' => $data->gender,
                    'contact' => $data->contact,
                    'uid' => $data->header('signature')
                ));

                return response()->json(['message' => "Your Profile was updated..!"], 200);
            } else {

                $store = new user_profile;
                $store->name = $data->name;
                $store->email = $data->email;
                $store->gender = $data->gender;
                $store->contact = $data->contact;
                $store->uid = $data->header('signature');
                if ($store->save()) {
                    return response()->json(['message' => 'Your Profile was updated..!'], 200);
                }
            }
        } else {
            return response()->json(['message' => "Your access credentials wrong..!"], 400);
        }
    }

    public function createShippingAddress(Request $data)
    {
        $store = new ship_address;
        $store->name = $data->name;
        $store->street = $data->street;
        $store->city = $data->city;
        $store->province = $data->province;
        $store->zip = $data->zip;
        $store->contact = $data->contact;
        $store->uid = $data->header('signature');

        if ($store->save()) {
            return response()->json(['message' => 'Your shipping address was created..!'], 200);
        } else {
            return response()->json(['message' => 'Ship address not create'], 400);
        }
    }

    public function updateShippingAddress(Request $data)
    {
        if (ship_address::where('id', $data->address_id)->exists()) {

            ship_address::where('id', $data->address_id)->update(array(
                'name' => $data->name,
                'street' => $data->street,
                'city' => $data->city,
                'province' => $data->province,
                'zip' => $data->zip,
                'contact' => $data->contact,
                'uid' => $data->header('signature')
            ));

            return response()->json(['message' => "Your ship address was updated..!"], 200);
        }
    }


    public function deleteShippingAddress(Request $data)
    {
        if (ship_address::where('id', $data->header('address_id'))->exists()) {
            $delteAddres = ship_address::where('id', $data->header('address_id'))->first();
            if ($delteAddres->delete()) {
                return response()->json(['message' => "Your ship address was deleted..!"], 200);
            } else {
                return response()->json(['message' => "Ship address not deleted"], 400);
            }
        }
    }
}
