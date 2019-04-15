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
    Route::get('users', function () {
        // 匹配包含 "/admin/users" 的 URL
    });

    Route::get('center', 'CenterController@index')->middleware('auth');

    Route::get('release_task', 'ManagementController@task')->middleware('auth');

    Route::get('user', 'UserController@index')->middleware('auth');

    Route::get('funds', 'FundsController@index')->middleware('auth');

    Route::get('bind', 'BindController@index')->middleware('auth');

    Route::get('explain', 'ExplainController@index')->middleware('auth');

    Route::get('explain/push', 'ExplainController@push')->middleware('auth');

    Route::get('plan', 'PlanController@index')->middleware('auth');

    Route::get('ban', 'BanController@index')->middleware('auth');

    Route::get('api_doc', 'UserController@doc')->middleware('auth');

});

Auth::routes();


