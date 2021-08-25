<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\model\product;
use App\model\product_stock_status;

class apiProductController extends Controller
{
    public function storeProduct(Request $data)
    {

        $store = new product;
        $store->cid = $data->cid;

        if ($data->name == null) {
            $store->name = "no name";
        } else {
            $store->name = $data->name;
        }

        $store->price = $data->price;
        $store->description = $data->description;
        $store->stock = $data->stock;
        $store->unit_weight = $data->unitWeight;
        $store->unit = $data->unit;


        # store main image
        $image = $data->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $storepath = public_path('./products');
        $image->move($storepath,  $imageName);
        $store->image = $imageName;


        /*
        $image = $data->file('image')->getRealPath();
        $fileContent = file_get_contents($image);
        $convBase64 = base64_encode($fileContent);
        #$store->image = $convBase64;
        */

        if ($store->save()) {
            #get product id
            $pid = product::orderBy('pid', 'DESC')->first('pid');
            #set product stock status
            $stock_status = new product_stock_status;
            $stock_status->pid = $pid->pid;
            $stock_status->save();

            return response()->json(['message' => "product added", 'status' => 200]);
        } else {
            return response()->json(['message' => "something wrong", 'status' => 404]);
        }
    }
}
