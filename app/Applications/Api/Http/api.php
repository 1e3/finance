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

    Route::post('singin',['as'=>'singin','uses'=>'LoginController@login']);

    Route::post('singup',['as'=>'singup','uses'=>'RegisterController@register']);
});

//Route::resource('users','UserController');

