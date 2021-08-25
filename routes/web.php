<?php

use App\Http\Controllers\admin\login;
use App\Http\Controllers\admin\dashboard;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\orderController;
#use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/admin/dashboard');
});
Route::get('/rt-admin', function () {
    return view('Admin/RT-Login');
});

#-------------------- [ ADMIN ROUTES] --------------------#

#------ [ lOGIN ] -----#
Route::get('/admin', [login::class, 'index']);

#------ [ DASHBOARD ] -----#
Route::get('/dashboard', [dashboard::class, 'index']);

#------ [ PRODUCT ] -----#
Route::get('/product', [productController::class, 'index']);
Route::get('/product/create', [productController::class, 'productCreate']);
Route::post('/product/create/store', [productController::class, 'productStore']);
Route::get('/product/delete', [productController::class, 'productDelete']);
Route::post('/product/update/store', [productController::class, 'productUpdate']);
Route::get('/product/stock/update/staus', [productController::class, 'productStockStatusUpdate']);
#------ [ CATEGORY ] -----#
Route::get('/category', [categoryController::class, 'category']);
Route::get('/category/main/delete', [categoryController::class, 'deleteMainCategory']);
Route::post('/category/main/store', [categoryController::class, 'storeMainCategory']);
Route::post('/category/sub/store', [categoryController::class, 'storeSubCategory']);

#------ [ ORDER ] -----#
Route::get('/order', [orderController::class, 'order']);
