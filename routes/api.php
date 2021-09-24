<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Facade\FlareClient\Http\Response;
use App\model\order_product;


use App\Http\Controllers\api\admin\apiCategoryController;
use App\Http\Controllers\api\admin\apiProductController;
use App\Http\Controllers\api\admin\apiUserController;
use App\Http\Controllers\api\admin\apiOrderController;
use App\Http\Controllers\api\admin\apiSaleController;

#--------------- [ client controllers ] ---------------
use App\Http\Controllers\api\client\apiClientAuthController;
use App\Http\Controllers\api\client\apiClientUserController;
use App\Http\Controllers\api\client\apiClientOrderController;
use App\Http\Controllers\api\client\apiClientCartController;
use App\Http\Controllers\api\client\apiClientSearchController;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


#---------------- [ CATEGORY ]--------------#

Route::get('/category/sub', [apiCategoryController::class, 'getSubCategory']);

//------------------------------- [ AUTH API ROUTES ] ---------------------------------\\

#user login
Route::post('/auth/client/login', [apiClientAuthController::class, 'clientLogin']);
#user register
Route::post('/auth/client/register', [apiClientAuthController::class, 'clientRegister']);
#check phone number exist or not
Route::get('/auth/check/number', [apiClientAuthController::class, 'checkNumberOrNot']);
#forgot password 
Route::post('/auth/password/forgot', [apiClientAuthController::class, 'forgotUserPassword']);



# check access token for requested user
Route::middleware(['check.token'])->group(function(){

    //------------------------------- [ PROFILE API ROUTES ] ---------------------------------\\

    #profile
    Route::get('/user/profile', [apiClientUserController::class, 'getUserProfile']);
    Route::post('/user/profile/update', [apiClientUserController::class, 'updateUserProfile']);
    Route::post('/user/profile/image/update', [apiClientUserController::class, 'updateUserProfileImage']);
    #ship address
    Route::get('/ship/address', [apiClientUserController::class, 'getUserShipAddress']);
    Route::get('/ship/address/delete', [apiClientUserController::class, 'deleteUserShipAddress']);
    Route::post('/ship/address/create', [apiClientUserController::class, 'createUserShipAddress']);
    Route::post('/ship/address/update', [apiClientUserController::class, 'updateUserShipAddress']);
    #change password
    Route::post('/user/password/change', [apiClientUserController::class, 'changeUserPassword']);

    
});


//------------------------------- [ CATEGORY API ROUTES ] ---------------------------------\\
#category
Route::get('/category/main/get', [apiCategoryController::class, 'getMainCategory']);

//------------------------------- [ PRODUCT API ROUTES ] ---------------------------------\\
#product get by category
Route::get('/product', [apiProductController::class, 'getProduct']);
Route::get('/product/info', [apiProductController::class, 'getProductInfo']);
Route::get('/product/best/sell',[apiProductController::class,'getBestSellProducts']);
Route::get('/product/offer',[apiProductController::class,'getProductOffer']);
Route::get('/product/trending',[apiProductController::class,'getTrendingProducts']);
Route::get('/product/loved',[apiProductController::class,'getMostLovedProducts']);

#set product viewed information
Route::post('/product/viewed',[apiProductController::class,'storeProductViewedInformation']);
#store product 
Route::post('/product/store', [apiProductController::class, 'storeProduct']);
#admin get product name id by catgory
Route::get('/product/by/category', [apiProductController::class, 'getProductByCategory']);

//------------------------------- [ CART API ROUTES ] ---------------------------------\\
Route::get('/user/cart', [apiClientCartController::class, 'getCart']);
Route::get('/user/add/cart', [apiClientCartController::class, 'addCart']);
Route::get('/user/cart/delete', [apiClientCartController::class, 'deleteCart']);
Route::get('/user/cart/qty/update', [apiClientCartController::class, 'qtyUpdate']);


//------------------------------- [ ORDER API ROUTES ] ---------------------------------\\

#place order
Route::post('/user/order/place', [apiClientOrderController::class, 'userPlaceOrder']);
Route::get('/user/order', [apiClientOrderController::class, 'getPlaceOrder']);

#admin
Route::get('/order/view/info', [apiOrderController::class, 'getOrderViewInfo']);

//------------------------------- [ SEARCH API ROUTES ] ---------------------------------\\
Route::get('/search', [apiClientSearchController::class, 'userFindProduct']);

#---------------- [ TEST ] --------------
Route::get('/test', ['middleware' => 'demo', 'uses' => [apiUserController::class, 'deleteShippingAddress']]);

#---------------- [ ORDER ]--------------#
Route::post('/user/order/place/create', [apiOrderController::class, 'createPlaceOrder']);

//------------------------------- [ SALES API ROUTES ] ---------------------------------\\
Route::get('/banner', [apiSaleController::class, 'getBanners']);