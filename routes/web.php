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

    Route::get('center', 'CenterController@index')->name('user.center')->middleware('auth');

    // 发布管理
    Route::any('management/release_task', 'ManagementController@task')->name('user.release_task')->middleware('auth');
    Route::get('management/release_task/success', 'ManagementController@success')->name('user.release_task.success')->middleware('auth');
    Route::get('management/release_task/info', 'ManagementController@info')->name('user.release_task.info')->middleware('auth');
    Route::post('management/release_task/id', 'ManagementController@change_id')->name('user.release_task.id')->middleware('auth');
    Route::post('management/release_task/pay', 'ManagementController@pay')->name('user.release_task.pay')->middleware('auth');

    Route::get('management/advance_duty', 'ManagementController@advance')->name('user.advance_duty')->middleware('auth');
    Route::post('management/advance_duty', 'ManagementController@advance')->name('advance_duty.getList')->middleware('auth');

    Route::get('management/browse_task', 'ManagementController@browse')->name('user.browse_task')->middleware('auth');
    Route::post('management/browse_task', 'ManagementController@browse')->name('browse.getList')->middleware('auth');

    Route::get('management/advance_task', 'ManagementController@advance_task')->name('user.task')->middleware('auth');
    Route::post('management/advance_task/list','ManagementController@advance_task')->name('advance_task.getList')->middleware('auth');
    Route::post('management/advance_task/check','ManagementController@advance_task_check')->name('check.advance_task.check')->middleware('auth');

    Route::get('management/release_task/delete', 'ManagementController@delete')->name('user.release_task.delete')->middleware('auth');

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

    // 用户设置
    Route::get('setting','UserController@setting')->name('user.setting')->middleware('auth');
    Route::post('setting','UserController@setting')->name('user.setting')->middleware('auth');

});

Route::prefix('admin')->group(function(){
    Route::get('notice','NoticeController@index',function (){
        echo active_class(if_route('admin.notice'), 'active', '');
    })->name('admin.notice')->middleware('auth');
    Route::post('notice','NoticeController@store')->middleware('auth');
    Route::post('uploadImage','NoticeController@upload')->middleware('auth');

    // 充值审核
    Route::get('check/fund','CheckController@fund')->name('admin.fund')->middleware('auth');
    Route::post('fund/list','CheckController@fund_list')->name('check.fund.getList')->middleware('auth');
    Route::any('fund/check/{id?}','CheckController@fund_check')->name('check.fund')->middleware('auth');
    Route::post('fund/confim','CheckController@fund_confim')->name('check.fund.confim')->middleware('auth');

    // 任务审批
    Route::get('check/task','CheckController@task')->name('admin.task')->middleware('auth');
    Route::post('check/task','CheckController@task')->name('check.task.getList')->middleware('auth');
    Route::post('check/task/check','CheckController@task_check')->name('check.task.check')->middleware('auth');

    // 店铺审核
    Route::get('check/shop','CheckController@shop')->name('admin.shop')->middleware('auth');
    Route::post('check/shop/list','CheckController@shop')->name('check.shop.getList')->middleware('auth');
    Route::any('check/shop/{id?}','CheckController@shop_check')->name('check.shop')->middleware('auth');

    // 买手审核
    Route::get('check/buyer','CheckController@buyer')->name('admin.buyer')->middleware('auth');
    Route::post('check/buyer/list','CheckController@buyer')->name('check.buyer.getList')->middleware('auth');
    Route::post('check/buyer/check','CheckController@buyer_check')->name('check.buyer.check')->middleware('auth');

    Route::get('check/bank','CheckController@bank')->name('admin.bank')->middleware('auth');
    Route::post('check/bank/list','CheckController@bank')->name('check.bank.getList')->middleware('auth');
    Route::post('check/bank/check','CheckController@bank_check')->name('check.bank.check')->middleware('auth');

    Route::get('check/certification','CheckController@certification')->name('admin.certification')->middleware('auth');
    Route::post('check/certification/list','CheckController@certification')->name('check.certification.getList')->middleware('auth');
    Route::post('check/certification/check','CheckController@certification_check')->name('check.certification.check')->middleware('auth');

    Route::get('check/advance','CheckController@advance')->name('admin.advance')->middleware('auth');
    Route::post('check/advance/list','CheckController@advance')->name('check.advance.getList')->middleware('auth');
    Route::post('check/advance/check','CheckController@advance_check')->name('check.advance.check')->middleware('auth');
});

Route::resource('users', 'UserController');
Route::resource('permissions', 'PermissionController');
Route::resource('roles', 'RoleController');

Route::get('charge','ChargeController@index')->name('charge')->middleware('auth');
Route::post('charge/online','ChargeController@online')->name('charge.online')->middleware('auth');
Route::post('charge/bank','ChargeController@bank')->name('charge.bank')->middleware('auth');

Route::get('register/consumer', 'Auth\RegisterController@register_consumer')->name('register.consumer');

// 密码重置邮箱
// Route::get('password/email','Auth\PasswordController@getEmail');
// Route::post('password/email','Auth\PasswordController@postEmail');
// Route::get('password/reset/','Auth\PasswordController@getReset');
// Route::post('password/reset','Auth\PasswordController@postReset');

// //填写重置密码邮箱页面
// Route::get('/reset','AuthController@reset');
// //发送重置密码邮件
// Route::post('/resetemail','AuthController@ResetEmail');
// //重置密码页
// Route::get('/password/reset/{token}','AuthController@passwordreset');
// //重置密码逻辑
// Route::post('/password/reset','AuthController@reseting');


Auth::routes();



