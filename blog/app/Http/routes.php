<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::any('admin/login', 'Admin\LoginController@login');
//    Route::any('admin/crypt', 'Admin\LoginController@crypt');
    Route::get('admin/code', 'Admin\LoginController@code');
    Route::any('past', 'Admin\IndexController@test1');
});

Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {

    Route::any('index', 'IndexController@index');
    Route::any('info', 'IndexController@info');
    Route::any('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');


});
