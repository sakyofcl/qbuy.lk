<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Facade\FlareClient\Http\Response;

use App\Http\Controllers\api\admin\apiCategoryController;
use App\Http\Controllers\api\admin\apiProductController;
use App\Http\Controllers\api\admin\apiUserController;
use App\Http\Controllers\api\admin\apiOrderController;

#--------------- [ client controllers ] ---------------
use App\Http\Controllers\api\client\apiClientAuthController;
use App\Http\Controllers\api\client\apiClientUserController;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


#---------------- [ CATEGORY ]--------------#

Route::get('/category/sub', [apiCategoryController::class, 'getSubCategory']);


#---------------- [ PRODUCT ]--------------#
Route::post('/product/store', [apiProductController::class, 'storeProduct']);

//------------------------------- [ AUTH API ROUTES ] ---------------------------------\\

//------- [ GET ] -------\\

//------- [ POST ] -------\\

#user login
Route::post('/auth/client/login', [apiClientAuthController::class, 'clientLogin']);
#user register
Route::post('/auth/client/register', [apiClientAuthController::class, 'clientRegister']);

//------------------------------- [ PROFILE API ROUTES ] ---------------------------------\\

//------- [ GET ] -------\\
#get profile details
Route::get('/user/profile', [apiClientUserController::class, 'getUserProfile']);

//------- [ POST ] -------\\
#update user profile
Route::post('/user/profile/update', [apiClientUserController::class, 'updateUserProfile']);

Route::post('/user/create/store', [apiUserController::class, 'storeUser']);
#Route::post('/user/profile/update', [apiUserController::class, 'updateProfile']);
Route::post('/user/ship/create', [apiUserController::class, 'createShippingAddress']);
Route::post('/user/ship/update', [apiUserController::class, 'updateShippingAddress']);
Route::get('/user/ship/delete', [apiUserController::class, 'deleteShippingAddress']);

#---------------- [ TEST ] --------------
Route::get('/test', ['middleware' => 'storeUser', 'uses' => [apiUserController::class, 'deleteShippingAddress']]);

#---------------- [ ORDER ]--------------#
Route::post('/user/order/place/create', [apiOrderController::class, 'createPlaceOrder']);
