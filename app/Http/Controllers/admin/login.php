<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\model\admin;
class login extends Controller
{
    public function index()
    {
        return view('/admin/login');
    }
    public function adminLogin(Request $request){
        $admin = admin::where(['email' => $request->email])->first();
        
        if ($admin) {
            if ($request->password== $admin->password) {
                session()->put('admin',$admin->email);
                session()->put('adminname',$admin->name);
                return redirect('/dashboard');
              
            } else {
                return redirect('/admin');
            }
        }
    }
    public function adminLogout(Request $request){
        if(session()->has('admin')){
            session()->pull('admin');#it will delete the key
            session()->pull('adminname');
        }
        return redirect('/');
    }
}
