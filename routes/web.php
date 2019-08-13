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
Route::get('/show','GoodsController@goodsShow'); //商品展示
Route::get('/detail','GoodsController@goods_detail'); //商品详情
Route::get('/caradd','CarController@carAdd'); //购物车添加
Route::get('/carlist','CarController@carList'); //购物车首页
Route::post('/changeNum','CarController@changeNum'); //改变数据库数量
Route::post('/getCountPrice','CarController@getCountPrice'); //获取总价

Route::get('/orderadd','OrderController@order_create'); //去结算  创建订单
Route::get('/orderlist','OrderController@orderlist'); //订单页
Route::get('/pay', 'PayController@pay');//支付宝支付
Route::get('/aliReturn', 'PayController@aliReturn');//异步回调





//Auth认证
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
