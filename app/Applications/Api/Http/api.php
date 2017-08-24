<?php
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
Route::group(['prefix'=>'auth','as'=>'auth.'], function (){

    Route::post('signin',['as'=>'singin','uses'=>'LoginController@login']);
    Route::post('signup',['as'=>'singup','uses'=>'RegisterController@register']);
});

Route::group(['middleware'=>'jwt.auth'],function (){
    Route::resource('categories','CategoryController');
    Route::resource('houses','HouseController');
    Route::resource('roles','RoleController');
    Route::post('roles/{role}/attach/perms', ['as'=>'roles.attach.perms','uses'=>'RoleController@attach']);
    Route::post('roles/{role}/detach/perms', ['as'=>'roles.detach.perms','uses'=>'RoleController@detach']);
    Route::post('roles/{role}/attach/users', ['as'=>'roles.attach.users','uses'=>'RoleController@addUsers']);
    Route::post('roles/{role}/detach/users', ['as'=>'roles.detach.users','uses'=>'RoleController@removeUsers']);

    Route::get('invoices/{id}/resume',['as'=>'invoices.resume','uses'=>'InvoiceController@resume']);
    Route::get('invoices/house/{house}',['as'=>'invoices.house','uses'=>'InvoiceController@showByHouse']);
    Route::get('invoices/myinvoices',['as'=>'invoices.house','uses'=>'InvoiceController@myInvoices']);
    Route::get('invoices/associate',['as'=>'invoices.house','uses'=>'InvoiceController@associate']);
    Route::resource('invoices','InvoiceController');

    Route::resource('payments','PaymentController');
});

Route::get('auth/refresh',['middleware'=>'auth.api.renew','uses'=>'LoginController@refreshToken']);


