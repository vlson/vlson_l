<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
|
| Here is where you can register BLOG routes for your blog.
*/

/*Route::group(function (Request $request) {
    Route::get('/', 'Index\IndexController@index');
});*/


$router->group(['middleware'=>[]],function () use ($router){
    Route::get('/', 'Index\IndexController@index');

    Route::get('/test_queue', 'Index\IndexController@testQueue');
});
