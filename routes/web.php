<?php

use App\Http\Controllers\admin\login;
use App\Http\Controllers\admin\dashboard;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\orderController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\admin\offerController;
use App\Http\Controllers\admin\saleController;
#use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/admin/under-construction');
});

#-------------------- [ ADMIN ROUTES] --------------------#

#------ [ lOGIN ] -----#
Route::get('/admin', [login::class, 'index']);
Route::post('/login', [login::class, 'adminLogin']);

Route::group(['middleware' => 'admin.check'], function () {


    #------ [ lOGOUT ] -----#
    Route::get('/logout', [login::class, 'adminLogout']);
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
    Route::get('/category-tab', [categoryController::class, 'category']);
    Route::get('/category/main/delete', [categoryController::class, 'deleteMainCategory']);
    Route::post('/category/main/store', [categoryController::class, 'storeMainCategory']);
    Route::post('/category/main/edit', [categoryController::class, 'editMainCategory']);
    Route::post('/category/sub/store', [categoryController::class, 'storeSubCategory']);

    #------ [ OFFER ] -----#
    Route::get('/offer', [offerController::class, 'index']);
    Route::post('/offer/place', [offerController::class, 'placeOffer']);
    Route::post('/offer/update/store', [offerController::class, 'updateOffer']);
    Route::get('/offer/delete', [offerController::class, 'deleteOffer']);
    #------ [ ORDER ] -----#
    Route::get('/order', [orderController::class, 'order']);
    Route::get('/order/accept', [orderController::class, 'orderAccept']);
    Route::get('/order/status/change', [orderController::class, 'changeOrderStatus']);

    #------ [ USER ] -----#
    Route::get('/user', [userController::class, 'user']);
    Route::post('/admin/edit/user/profile', [userController::class, 'editUserProfile']);
    Route::post('/admin/change/user/password', [userController::class, 'changeUserPassword']);
    Route::post('/admin/delete/user', [userController::class, 'deleteUser']);
    Route::get('/user/info', [userController::class, 'userInfo']);
    Route::post('/admin/create/user',[userController::class, 'createUserAccount']);
    #------ [ SEARCH ] -----#
    



});

#------ [ SALES ] -----#

Route::post('/sale/add/banner', [saleController::class, 'addBanner']);