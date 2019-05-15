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

Route::redirect('/', '/user/center', 301);

Route::prefix('user')->group(function () {

    Route::get('center', 'CenterController@index',function (){
        echo active_class(if_route('user.center'), 'active', '');
    })->name('user.center')->middleware('auth');

    Route::get('management/release_task', 'ManagementController@task')->name('user.release_task')->middleware('auth');

    Route::get('management/advance_duty', 'ManagementController@advance')->name('user.advance_duty')->middleware('auth');

    Route::get('management/browse_task', 'ManagementController@browse')->name('user.browse_task')->middleware('auth');

    Route::get('funds/{type}', 'FundsController@index',function (){
        echo active_class(if_route('user.funds'), 'active', '');
    })->name('user.funds')->middleware('auth');

    Route::post('funds/capital/list', 'FundsController@capital')->name('capital.getList')->middleware('auth');

    Route::post('funds/brokerage/list', 'FundsController@brokerage')->name('brokerage.getList')->middleware('auth');

    Route::get('bind', 'BindController@index',function (){
        echo active_class(if_route('user.bind'), 'active', '');
    })->name('user.bind')->middleware('auth');

    Route::post('bind/shop','BindController@shop')->name('bind.shop')->middleware('auth');

    Route::post('bind/shop/list','BindController@list')->name('shop.getList')->middleware('auth');

    Route::get('explain', 'ExplainController@index',function (){
        echo active_class(if_route('user.explain'), 'active', '');
    })->name('user.explain')->middleware('auth');

    Route::get('explain/push', 'ExplainController@push')->middleware('auth');
    Route::post('explain/push', 'ExplainController@refer')->name('explain')->middleware('auth');
    Route::post('explain/list', 'ExplainController@explain_list')->name('explain.getList')->middleware('auth');

    Route::get('plan', 'PlanController@index',function (){
        echo active_class(if_route('user.plan'), 'active', '');
    })->name('user.plan')->middleware('auth');

    Route::get('ban', 'CenterController@ban')->name('user.ban')->middleware('auth');
    Route::post('ban/list', 'CenterController@ban_list')->name('ban.getList')->middleware('auth');

    Route::get('api_doc', 'UserController@doc')->name('user.api_doc')->middleware('auth');

    Route::get('notice','NoticeController@show')->name('notice')->middleware('auth');

    Route::get('notice/help','NoticeController@help')->name('help')->middleware('auth');

});

Route::prefix('admin')->group(function(){
    Route::get('notice','NoticeController@index',function (){
        echo active_class(if_route('admin.notice'), 'active', '');
    })->name('admin.notice')->middleware('auth');
    Route::post('notice','NoticeController@store')->middleware('auth');
    Route::post('uploadImage','NoticeController@upload')->middleware('auth');

    Route::get('fund','CheckController@fund')->name('admin.fund')->middleware('auth');

    Route::post('fund/list','CheckController@fund_list')->name('check.fund.getList')->middleware('auth');
    Route::any('fund/check/{id?}','CheckController@fund_check')->name('check.fund')->middleware('auth');
    Route::post('fund/confim','CheckController@fund_confim')->name('check.fund.confim')->middleware('auth');

    Route::get('shop','CheckController@shop')->name('admin.shop')->middleware('auth');

    Route::post('shop/list','CheckController@shop_list')->name('check.shop.getList')->middleware('auth');
});

Route::resource('users', 'UserController');
Route::resource('permissions', 'PermissionController');
Route::resource('roles', 'RoleController');

Route::get('charge','ChargeController@index')->name('charge')->middleware('auth');
Route::post('charge/online','ChargeController@online')->name('charge.online')->middleware('auth');
Route::post('charge/bank','ChargeController@bank')->name('charge.bank')->middleware('auth');

Route::get('register/consumer', 'Auth\RegisterController@register_consumer')->name('register.consumer');
//Route::post('register/{type}', 'Auth\AuthController@register');
//Route::auth();

Auth::routes();



