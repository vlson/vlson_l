<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    // 博客文章
    $router->resource('article', ArticleController::class);

    // 博客文章标签
    $router->resource('label', LabelController::class);

    // 博客文章分类
    $router->resource('category', CategoryController::class);

});
