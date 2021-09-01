<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\model\category;
use App\model\product;
use App\model\product_stock_status;
use App\model\sub_category;


class productController extends Controller
{
    public function index()
    {
        $product = product::orderBy('date', 'DESC')->paginate(10);
        $stock_status = product_stock_status::all();
        $maincat = category::all();
        $subcat = sub_category::all();
        return view('admin/product/product', ['product' => $product, 'stock_status' => $stock_status, 'main' => $maincat, 'sub' => $subcat]);
    }
    public function productCreate()
    {
        $mainCat = category::all();
        return view('admin/product/add-product', ['main' => $mainCat]);
    }

    public function productStore(Request $data)
    {
        return $data;
    }
    public function productDelete(Request $data)
    {
        $del = product::where('pid', $data->pid)->first();
        $delStockStatus = product_stock_status::where('pid', $data->pid)->first();
        $delStockStatus->delete();
        $del->delete();
        File::delete(public_path("products/{$del->image}"));
        return back();
    }

    public function productUpdate(Request $data)
    {
        $storepath = public_path('./products');

        if (isset($data->image)) {
            //delete preivious image
            $getimg = product::find($data->pid, ['image']);
            File::delete(public_path("products/" . $getimg['image']));
            //set new image
            $image = $data->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($storepath,  $imageName);
            product::where('pid', $data->pid)->update(array(
                'image' => $imageName
            ));
        }

        $update = product::where('pid', $data->pid)->update(array(
            'name' => $data->name,
            'description' => $data->description,
            'price' => $data->price,
            'stock' => $data->stock,
            'unit_weight' => $data->unit_weight,
            'unit' => $data->unit,
            'date' => date('Y-m-d H:i:s'),
            'cid' => $data->cid,
            'sub_id' => $data->sub_id
        ));

        if ($update) {
            return back();
        }
    }

    public function productStockStatusUpdate(Request $data)
    {

        product_stock_status::where('pid', $data->pid)->update([
            'status' => $data->v
        ]);
        return back();
    }
}
