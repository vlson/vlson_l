<?php

namespace App\Admin\Controllers;

use App\Models\Blog\BlogArticleStaticsModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleStaticsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章浏览统计';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlogArticleStaticsModel());

        $grid->column('id', __('Id'));
        $grid->column('type', __('统计类型'))->using([1=>'点赞', 2=>'阅读']);
        $grid->column('art_id', __('文章ID'));
        $grid->column('ip', __('客户端Ip'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BlogArticleStaticsModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('统计类型'))->using([1=>'点赞', 2=>'阅读']);
        $show->field('art_id', __('文章ID'));
        $show->field('ip', __('客户端Ip'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BlogArticleStaticsModel());

        $form->text('type', __('统计类型'));
        $form->number('art_id', __('文章ID'));
        $form->ip('ip', __('客户端Ip'))->default('0.0.0.0');

        return $form;
    }
}
