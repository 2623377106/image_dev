<?php

use Illuminate\Support\Facades\Route;

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
//展示相册添加路由
Route::get('index','ImgController@index');
//设置文件自动上传路由
Route::post('file','ImgController@file');
//图片信息添加入库路由
Route::post('save','ImgController@save')->name('save')->middleware('checkage');
//展示图片列表路由
Route::get('imgindex','ImgController@imgindex')->name('img');
//定义删除图片路由
Route::delete('del/{id}','ImgController@del')->name('del');
