<?php
namespace App\Lib;
use Illuminate\Http\JsonResponse;
use App\model\user_token;
class Common{

    public static function json($status=false,$data=[],$message="!"){
        $res=new JsonResponse();
        return $res->setData(['status'=>$status,'data'=>$data,'message'=>$message]);
    }

    public static function getUserIdByToken($token){
        
        if($token){
            $user=user_token::where('access_token',$token)->first();
            if($user){
                return $user->uid;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
        
    }

}


