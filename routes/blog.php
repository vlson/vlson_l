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
    Route::get('/', 'IndexController@index');
    Route::get('/index', 'IndexController@index');

    Route::get('/article/{article_id}', 'ArticleController@detail')->where('article_id', '^[1-9][0-9]*$');

    Route::get('/test_queue', 'IndexController@testQueue');
});
