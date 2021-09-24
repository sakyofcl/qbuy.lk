<?php

namespace App\Http\Middleware\client\auth;

use Closure;
use App\Lib\Common;
use App\model\user_token;
class checkTokenMiddleware
{
    
    public function handle($request, Closure $next)
    {
        $userToken=$request->header('access_token');
        if($userToken){
            if(user_token::where('access_token',$userToken)->exists()){
                return $next($request);
            }
            else{
                return Common::json(false,[],"User not found!");
            }
        }
        else{
            return Common::json(false,[],"please put your signature");
        }
       
    }


}
