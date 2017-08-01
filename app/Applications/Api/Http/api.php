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
});

Route::get('auth/refresh',['middleware'=>'auth.api.renew','uses'=>'LoginController@refreshToken']);


