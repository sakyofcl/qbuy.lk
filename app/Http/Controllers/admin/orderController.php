<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\model\order;
use App\model\order_stage;
use App\model\ship_address;
use App\model\user;
use App\model\product;
use App\model\order_product;
use App\model\user_token;
use App\model\payment_method;


class orderController extends Controller
{
    public function order(Request $request)
    {

        
        $tab="new";
        if($request->tab){
            if($request->tab=="new"){
                $tab="new";
            }
            else if($request->tab=="process"){
                $tab="process";
            }
            else if($request->tab=="complete"){
                $tab="complete";
            }
            else if($request->tab=="cancelled"){
                $tab="cancelled";
            }
            else{
                $tab="new";
            }

        }
        else{
            $tab="new";
        }

        $orederData=DB::table('orders')
                ->select(
                    [
                        'orders.oid',
                        'orders.date',
                        'orders.uid',
                        'orders.payment',
                        'users.phone',
                        'order_stages.stage',
                        'user_profiles.image'
                        
                    ]
                )
                ->join('users','users.uid','=','orders.uid')
                ->join('user_profiles','user_profiles.uid','=','orders.uid')
                ->join('order_stages','order_stages.oid','=','orders.oid')
                ->where(['order_stages.stage'=>$tab])
                ->orderBy('orders.date','DESC')
                ->paginate(10);
            

        return view('admin/order/order',['orders'=>$orederData,'tab'=>$tab]);
    }
}
