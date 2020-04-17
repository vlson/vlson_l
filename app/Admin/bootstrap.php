<?php

use App\Admin\Extensions\WangEditor;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);

// wang富文本编辑器
Form::extend('editor', WangEditor::class);

// 顶部导航栏
Admin::navbar(function(\Encore\Admin\Widgets\Navbar $navbar){
    $navbar->left(view('admin/search-bar'));
});
