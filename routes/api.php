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

// 用于登录，注册
Route::post('/login','ApiController@app_login');
Route::post('/register','ApiController@app_register');
Route::post('/reset','ApiController@reset_password');


// 业务逻辑
Route::post('/test','CheckController@shop_list_test');
Route::post('/task_list','ApiController@task_list');
Route::post('/getOrderList','ApiController@order_list');
