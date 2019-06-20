<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 首页接口
Route::post('/getUserInfo','ApiController@user_info');

// 用于登录，注册
Route::post('/login','ApiController@app_login');
Route::post('/register','ApiController@app_register');
Route::post('/reset','ApiController@reset_password');


// 业务逻辑
Route::post('/test','CheckController@shop_list_test');
Route::post('/task_list','ApiController@task_list');
Route::post('/getOrderList','ApiController@order_list');
Route::post('/orderReceiving','ApiController@order_receiving');
Route::post('/orderInfo','ApiController@order_info');
Route::post('/orderOff','ApiController@order_off');
Route::post('/orderComplete','ApiController@order_complete');

Route::post('/orderCompleteDF','ApiController@order_complete_df');

Route::post('/orderDfCheck','ApiController@order_df_check');

Route::post('/orderHas','ApiController@order_has');

Route::post('/addBuyer','ApiController@add_buyer');
Route::post('/getBuyerList','ApiController@buyer_list');
Route::post('/getBuyerInfo','ApiController@buyer_info');
Route::post('/updateBuyer','ApiController@update_buyer');
Route::post('/deleteBuyer','ApiController@delete_buyer');

// 个人中心
Route::post('/getCertificationList','ApiController@certification_list');
Route::post('/addCertification','ApiController@add_certification');

Route::post('/getBankList','ApiController@bank_list');
Route::post('/addBank','ApiController@add_bank');

// 提现
Route::post('/addAdvance','ApiController@add_advance');
Route::post('/getAdvanceList','ApiController@advance_list');


