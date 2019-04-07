<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/admin/statistics', 301);

Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // 匹配包含 "/admin/users" 的 URL
    });

    Route::get('center', 'CenterController@index')->middleware('auth');

    Route::get('user', 'UserController@index')->middleware('auth');

    Route::get('funds', 'FundsController@index')->middleware('auth');
    Route::get('demand/{id}', 'DemandController@detail')->middleware('auth');
    Route::get('demand/check/{id}', 'DemandController@check')->middleware('auth');

    Route::get('activity', 'ActivityController@index')->middleware('auth');

    Route::get('api_doc', 'UserController@doc')->middleware('auth');

});

Auth::routes();

