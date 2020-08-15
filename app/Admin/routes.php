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

    // 静态资源上传COS
    $router->resource('tools/cos-upload', CosUploadController::class);

    // 微信公众号access_token
    $router->any('wechat-official/access_token', 'WechatController@WechatOfficialAccessToken');

    // 微信公众号菜单查询
    $router->any('wechat-official/menu_query', 'WechatController@WechatOfficialMenuQuery');

    // 微信公众号菜单查询
    $router->any('wechat-official/menu_set', 'WechatController@WechatOfficialMenuSet');

});
