<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Wechat Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your wechat.
*/

/*Route::group(function (Request $request) {
    Route::get('/', 'Index\IndexController@index');
});*/


$router->group(['middleware'=>[]],function () use ($router){
    Route::any('wechat/tokenValid', 'WechatController@tokenValid');
});
