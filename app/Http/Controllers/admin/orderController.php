<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
    public function order($name,Request $request)
    {
        
        $tab="new";
        $rawQuery="order_stages.stage = 'new' ";
        if($name){
            if($name=="new"){
                $rawQuery="order_stages.stage = 'new' ";
                $tab="new";
            }
            else if($name=="process"){
                $rawQuery=" order_stages.stage = 'process' OR order_stages.stage = 'couriered' OR order_stages.stage = 'delivered' ";
                $tab="process";
            }
            else if($name=="complete"){
                $rawQuery="order_stages.stage = 'complete' ";
                $tab="complete";
            }
            else if($name=="cancelled"){
                $rawQuery="order_stages.stage = 'cancelled' ";
                $tab="cancelled";
            }
            else{
                $rawQuery="order_stages.stage = 'new' ";
                $tab="new";
            }

        }
        else{
            $rawQuery="order_stages.stage = 'new' ";
            $tab="new";
        }

        $orederData=DB::table('orders')
                ->select(
                    [
                        'orders.oid',
                        'orders.date',
                        'orders.uid',
                        'orders.paid',
                        'orders.payment',
                        'order_stages.stage'
                        
                    ]
                )
                ->join('order_stages','order_stages.oid','=','orders.oid')
                ->whereRaw($rawQuery)
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
            ->whereRaw(" order_stages.stage = 'process' OR order_stages.stage = 'couriered' OR order_stages.stage = 'delivered' ")
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

                session()->flash([
                    'message', 'Task was successful!',
                    'status'=>1
                ]);
                return "ok";
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

                    return back()->with(
                        [
                            'message'=>"This order is cancelled #$request->oid",
                            'status'=>1
                        ]
                    );
                }
                else if($request->status=="process"){
                    order::where('oid', $request->oid)->update(array(
                        'status' =>"process"
                    ));
                    order_stage::where('oid', $request->oid)->update(array(
                        'stage' =>"process"
                    ));

                    return back()->with(
                        [
                            'message'=>"Successfully accepted this order #$request->oid",
                            'status'=>1
                        ]
                    );
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


    public function changeOrderStatusAndPaid(Request $request){
        $validator=Validator::make($request->all(),[
            'oid'=>'required|numeric',
            'paid'=>'required|numeric',
            'status'=>'required',
        ]);

        if($validator->fails()){
            return back()->with(
                [
                    'message'=>"All fields are required",
                    'status'=>0
                ]
            );
        }

        if(order::where('oid',$request->oid)->exists()){
            if($request->paid==1 && $request->status=="delivered"){

                order::where('oid', $request->oid)->update(array(
                    'status' =>"complete",
                    'paid'=>1
                ));
                order_stage::where('oid', $request->oid)->update(array(
                    'stage' =>"complete"
                ));

                return back()->with(
                    [
                        'message'=>"This order is complete #$request->oid",
                        'status'=>1
                    ]
                );

            }
            else{
                $status="process";
                $paid=0;
                
                if($request->status=="couriered"){
                    $status="couriered";
                }
                elseif($request->status=="delivered"){
                    $status="delivered";
                }

                if($request->paid==1){
                    $paid=1; 
                }

                order::where('oid', $request->oid)->update(array(
                    'paid'=>$paid
                ));
                order_stage::where('oid', $request->oid)->update(array(
                    'stage' =>$status
                ));

               
                $paidMsg= $paid==0?'unpaid':'paid';
                return back()->with(
                    [
                        'message'=>"This order is $status"." and payment is $paidMsg",
                        'status'=>1
                    ]
                );
            }

            
        }
        else{
            return back()->with(
                [
                    'message'=>"Order not found!",
                    'status'=>2
                ]
            );
        }


        
    }
}
