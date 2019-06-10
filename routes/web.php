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

Route::get('/', function () {
    return view('welcome');
});

// 用户注册
Route::resource('/user/reg','Controller\RegController');

// 用户登录
Route::resource('/user/login','Controller\LoginController');

// 用户中心
Route::get('/user/index','Controller\UserController@index');
// 用户聊天内容
Route::post('/user/desc','Controller\UserController@content');
// ajax 轮询
Route::post('/user/detail','Controller\UserController@detail');