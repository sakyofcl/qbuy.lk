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
                        'order_stages.stage',
                    ]
                )
                ->join('order_stages','order_stages.oid','=','orders.oid')
                ->where(['order_stages.stage'=>$tab])
                ->orderBy('orders.date','DESC')
                ->paginate(10);
            
        $orderProduct=order_product::get(['oid','price','qty']);


        #get count of order in status;
        
        $countNew=DB::table('order_stages')
            ->join('orders','orders.oid','order_stages.oid')
            ->where('order_stages.stage','=','new')
            ->count('order_stages.stage');
        
        $countComplete=DB::table('order_stages')
            ->join('orders','orders.oid','order_stages.oid')
            ->where('order_stages.stage','=','complete')
            ->count('order_stages.stage');

        $countProcess=DB::table('order_stages')
            ->join('orders','orders.oid','order_stages.oid')
            ->where('order_stages.stage','=','process')
            ->count('order_stages.stage');

        $countCancelled=DB::table('order_stages')
            ->join('orders','orders.oid','order_stages.oid')
            ->where('order_stages.stage','=','cancelled')
            ->count('order_stages.stage');

        
        
            

        return view('admin/order/order',
            [
                'orders'=>$orederData,
                'tab'=>$tab,
                'orderProduct'=>$orderProduct,
                'stageCount'=>
                    [
                        'new'=>$countNew,
                        'complete'=>$countComplete,
                        'process'=>$countProcess,
                        'cancelled'=>$countCancelled
                    ]
            ]
        );
    }



    public function orderAccept(Request $request){
        if($request->oid){
            if(order::where('oid', $request->oid)->exists()){
                $status="process";
                order::where('oid', $request->oid)->update(array(
                    'status' =>$status
                ));
                order_stage::where('oid', $request->oid)->update(array(
                    'stage' =>$status
                ));

                return back();
            }
            else{
                return back();
            }
        }
        else{
            return back();
        }
    }

    public function changeOrderStatus( Request $request){
        if($request->oid && $request->status ){
    
            if(order::where('oid', $request->oid)->exists()){

                if($request->status=="complete"){

                    $pointPercentage=0.1;
                    #get total price
                    $tot=DB::table('orders')
                        ->select(DB::raw('SUM(order_products.price*order_products.qty) as total'))
                        ->join('order_products','order_products.oid','=','orders.oid')
                        ->where('orders.oid','=',$request->oid)
                        ->first();
                    
                        #->sum('tot');
                        
                    $totalAmountOfPrice=$tot->total;

                    #calculate points
                    $points=round($totalAmountOfPrice*$pointPercentage);

                    #set points to user
                    $orderUser=order::where('oid',$request->oid)->first(['uid']);

                    if(user::where('uid',$orderUser->uid)->exists()){
                        #get user current points
                        $user=user::where('uid',$orderUser->uid)->first(['point']);
                        $currentPoints=$user->point;

                        user::where('uid',$orderUser->uid)->update(array(
                            'point' =>$currentPoints+$points
                        ));

                        
                    }
                    

                    order::where('oid', $request->oid)->update(array(
                        'status' =>"complete"
                    ));
                    order_stage::where('oid', $request->oid)->update(array(
                        'stage' =>"complete"
                    ));
                }
                else if($request->status=="cancelled"){
                    order::where('oid', $request->oid)->update(array(
                        'status' =>"cancelled"
                    ));
                    order_stage::where('oid', $request->oid)->update(array(
                        'stage' =>"cancelled"
                    ));
                }
                else if($request->status=="process"){
                    order::where('oid', $request->oid)->update(array(
                        'status' =>"process"
                    ));
                    order_stage::where('oid', $request->oid)->update(array(
                        'stage' =>"process"
                    ));
                }
                else if($request->status=="pending"){
                    order::where('oid', $request->oid)->update(array(
                        'status' =>"pending"
                    ));
                    order_stage::where('oid', $request->oid)->update(array(
                        'stage' =>"new"
                    ));
                }

                return back();
            }
            else{
                return back();
            }
        }
        else{
            return back();
        }
    }
}
