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
    $router->resource('blog/article', ArticleController::class);

    // 博客文章标签
    $router->resource('blog/label', LabelController::class);

    // 博客文章分类
    $router->resource('blog/category', CategoryController::class);

    // 博客文章浏览记录
    $router->resource('blog/article-statics', ArticleStaticsController::class);

});
