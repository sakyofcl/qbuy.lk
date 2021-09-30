<?php

namespace App\Http\Middleware\client\auth;

use Closure;
use App\Lib\Common;
use App\model\user;
class checkUserMiddleware
{
    
    public function handle($request, Closure $next)
    {
        $signature=$request->header('signature');
        if($signature){
            if(user::where('uid',$signature)->exists()){
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
