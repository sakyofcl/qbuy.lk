<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\model\category;
use App\model\product;
use App\model\product_stock_status;
use App\model\sub_category;


class productController extends Controller
{
    public function index(Request $request)
    {
        $product = product::orderBy('date', 'DESC')->paginate(10);
        $stock_status = product_stock_status::all();
        $maincat = category::all();
        $subcat = sub_category::all();

        if($request->maincat!=null && $request->maincat!=0){
            $product = product::where('cid',$request->maincat)->orderBy('date', 'DESC')->paginate(10);
        }
        
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
        if($data->pid){
            if(product::where('pid', $data->pid)->exists()){
                $del = product::where('pid', $data->pid)->first();
                $delStockStatus = product_stock_status::where('pid', $data->pid)->first();
                $delStockStatus->delete();
                $del->delete();
                File::delete(public_path("products/{$del->image}"));

                return back()->with(
                    [
                        'message'=>"Successfully product deleted.",
                        'status'=>1
                    ]
                );
            }
            else{
                return back()->with(
                    [
                        'message'=>"This product doesn't exist.",
                        'status'=>2
                    ]
                );
            }
            

            
        }

        return back()->with(
            [
                'message'=>"The Product id field is required.",
                'status'=>0
            ]
        );
      
        
    }

    public function productUpdate(Request $data)
    {
        $validator=Validator::make($data->all(),[
            'pid'=>'required|numeric',
            'name'=>'required',
            'price'=>'required|numeric',
            'weight'=>'numeric',
            'stock'=>'numeric'
        ]);

        if($validator->fails()){
            return back()->with(
                [
                    'message'=>"All fields are required",
                    'status'=>0
                ]
            );
            
        }

        
        $storepath = public_path('./products');
        $updateArray=['name' => $data->name,'price' => $data->price,'date' => date('Y-m-d H:i:s')];


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
        #return back();

        if($data->description){
            $updateArray['description']=$data->description;
        }
        if($data->weight){
            $updateArray['unit_weight']=$data->weight;
        }
        if($data->unit){
            $updateArray['unit']=$data->unit;
        }
        if($data->stock){
            $updateArray['stock']=$data->stock;
        }

       
        $update = product::where('pid', $data->pid)->update($updateArray);
        

        if ($update) {
            return back()->with(
                [
                    'message'=>"Successfully product updated.",
                    'status'=>1
                ]
            );
        }
        
    }

    public function productStockStatusUpdate(Request $data)
    {

        product_stock_status::where('pid', $data->pid)->update([
            'status' => $data->v
        ]);
        return back()->with(
            [
                'message'=>"Successfully stock status updated.",
                'status'=>1
            ]
        );
    }

    public function getProductByCategoryName($name){

        #$product = product::orderBy('date', 'DESC')->paginate(10);
        $stock_status = product_stock_status::all();
        $maincat = category::all();
        $subcat = sub_category::all();


        $data=[];
        if($name=="all"){
            $data=product::orderBy('date', 'DESC')->paginate(10);
        }
        else{
            $cid=category::where("name",$name)->first(["cid"]);
            if($cid){
                $data=product::where('cid',$cid->cid)->orderBy('date', 'DESC')->paginate(10);
            }
        }

        return view('admin/product/product', ['product' => $data, 'stock_status' => $stock_status, 'main' => $maincat, 'sub' => $subcat,'current'=>$name]);
    }

    public function searchProduct(Request $request){
        
        
        if($request->q){
            $stock_status = product_stock_status::all();
            $maincat = category::all();
            $subcat = sub_category::all();

            
            #final string;
            $ask=" ";
            #explode word by " "
            $word=explode(" ",$request->q);

            foreach($word as $wordItem){
                $ask.=metaphone($wordItem)." ";
            }


            #common all search
            $data=product::query()
            ->orWhere('key_tag', 'LIKE', "%{$ask}%") 
            ->orWhere('name', 'LIKE', $request->q)
            ->orderBy('date','DESC')
            ->paginate(10);
            
            if(count($data)>0){
                
                return view('admin/product/product', ['product' => $data, 'stock_status' => $stock_status, 'main' => $maincat, 'sub' => $subcat,'current'=>'0']);
            }
            else{
                return view('admin/product/product', ['product' => [], 'stock_status' => $stock_status, 'main' => $maincat, 'sub' => $subcat,'current'=>'0']);
            }

           
        }
    }

    
}
