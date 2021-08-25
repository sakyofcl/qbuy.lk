<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\model\order;
use App\model\order_stage;
use App\model\ship_address;
use App\model\user;
use App\model\product;
use App\model\order_product;

class apiOrderController extends Controller
{
    public function createPlaceOrder(Request $data)
    {

        $store = new order;
        $orderProduct = new order_product;
        $orderStage = new order_stage;
        $address = ship_address::where('id', $data->address)->first();

        #shipping address
        $store->name = $address->name;
        $store->address = $address->street;
        $store->city = $address->city;
        $store->phone = $address->contact;

        #payment method
        $store->payment = $data->payment;

        #order user
        $store->uid = $data->header('signature');

        #store order
        if ($store->save()) {
            #get order id
            $oid = order::orderBy('oid', 'DESC')->first('oid');
            #order product

            #order stage
            $orderStage->stage = "new";
            $orderStage->oid = $oid->oid;
            $orderStage->save();


            #order product
            $orderProductData = [];
            foreach ($data->product as $item) {
                $product = product::where('pid', $item['pid'])->first(['pid', 'name', 'price']);
                $orderProductData[] = [
                    'oid' => $oid->oid,
                    'pid' => $product->pid,
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => $item['qty']
                ];
            }
            if (DB::table('order_products')->insert($orderProductData)) {
                return response()->json(["message" => "order placed..!"], 200);
            } else {
                return response()->json(["message" => "order not placed"], 400);
            }
        }
    }
}
