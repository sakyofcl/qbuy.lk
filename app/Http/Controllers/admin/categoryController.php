<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\category;
use App\model\sub_category;
use Illuminate\Support\Facades\File;

class categoryController extends Controller
{
    public function category()
    {
        $maincat = category::all();
        $subcat = sub_category::all();
        return view('admin/category/category', ['main' => $maincat, 'sub' => $subcat]);
    }

    public function storeMainCategory(Request $data)
    {
        
        
        
        $store = new category;
        $store->name = $data->catname;

        # store main image
        if($data->file('image')){
            $image = $data->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $storepath = public_path('./category');
            $image->move($storepath,  $imageName);

            $store->image=$imageName;
        }
      
        
        if ($store->save()) {
            return back();
        }
    }

    public function deleteMainCategory(Request $data)
    {

        $maincat = category::findOrFail($data->cid);
        File::delete(public_path("category/{$maincat->image}"));
        $maincat->delete();
        return back();
    }
    public function storeSubCategory(Request $data)
    {
        $store = new sub_category;
        $store->name = $data->subname;
        $store->cid = $data->cid;
        if ($store->save()) {
            return back();
        }
    }

    public function editMainCategory(Request $request){
       
        $storepath = public_path('./category');
        
        
        if($request->image){
            
            $maincat = category::findOrFail( $request->catid);
            File::delete(public_path("./category/{$maincat->image}"));
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($storepath,  $imageName);
            category::where('cid', $request->catid)->update(array(
                    'image' => $imageName
            ));
        }
        
       
        if($request->catname){
            
            category::where('cid', $request->catid)->update(array(
                'name' => $request->catname
            ));
        }
       
        
        return back();

    }
}
