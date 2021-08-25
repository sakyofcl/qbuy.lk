<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\category;
use App\model\sub_category;

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
        if ($store->save()) {
            return back();
        }
    }

    public function deleteMainCategory(Request $data)
    {
        $maincat = category::findOrFail($data->cid);
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
}
