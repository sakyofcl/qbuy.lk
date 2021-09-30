<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
}
