<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\model\category;
use App\model\offer;
use App\model\product;
use Illuminate\Support\Facades\DB;

class offerController extends Controller
{
    public function index(){
        #this is all the offer status
        $status1='active';
        $status2='expired';
        $status3='schedule';

        $currentDate=date_create(date('Y-m-d'));

        $data=DB::table('offers')
            ->select(
                [
                    'products.pid',
                    'products.name',
                    'products.price',
                    'offers.offer_id',
                    'offers.offer_price',
                    'offers.start',
                    'offers.end',
                ])
            ->join('products','products.pid','=','offers.pid')
            ->orderBy('offers.date','DESC')
            ->paginate(10);

        foreach($data as $dataItem){
            $endDate=date_create($dataItem->end);
            $startDate=date_create($dataItem->start);

            $diff_current_end=date_diff($currentDate,$endDate);
            $diff_current_start=date_diff($startDate,$currentDate);

            #check active
            if($diff_current_start->format("%R%a")>=0 && $diff_current_end->format("%R%a")>=0){
                $dataItem->status=$status1;
            }
            #check expird
            else if($diff_current_end->format("%R%a")<0){
                $dataItem->status=$status2;
            }
            #check schedule
            else if($diff_current_start->format("%R%a")<0){
                $dataItem->status=$status3;
            }
           
            
        }
        


        $category=category::all();
        return view('/admin/offer/offer',['category'=>$category,'offer'=>$data]);
    }
    public function placeOffer(Request $request){
        
        $validation=Validator::make($request->all(),
            [
                'pid'=>'required|numeric',
                'price'=>'required|numeric',
                'start'=>'required|date',
                'end'=>'required|date',
            ]
        );
        if(!$validation->fails()){
            if(product::where('pid',$request->pid)->exists()){
                $end=$request->end;
                $start=$request->start;
                $current=date_create(date('Y-m-d'));
                $endDate=date_create($end);
                $startDate=date_create($start);
                
                $diffCurrentEnd=date_diff($current,$endDate);
                $diffCurrentStart=date_diff($current,$startDate);
                
                if($diffCurrentStart->format("%R%a")>=0 && $diffCurrentEnd->format("%R%a")>=0){
                    
                    $store=new offer;
                    $store->pid=$request->pid;
                    $store->offer_price=$request->price;
                    $store->start=$startDate;
                    $store->end=$endDate;

                    #set tag default gentral
                    $store->tag="general";

                    if($store->save()){
                        return back();
                    }

                }
                else{
                    return "not ok";
                }
               
                return gettype($endDate) ."  ".gettype($current);

                #$end=date_create( strval($request->end));
                /*
                return $end;
                if($current<=$end){
                    return "ok";
                }
                else{
                    return "wrong";
                }
                */
                
            }
            else{
                return back();
            }
            
        }
        else{
            return $request->all();
        }

        
    }
}
