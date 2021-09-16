<?php

namespace App\Http\Middleware\admin\auth;

use Closure;

class checkLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session()->has('admin')){
            return $next($request); 
        }
        else{
            return redirect('/admin');
        }
    }
}
