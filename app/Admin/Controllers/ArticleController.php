<?php

namespace App\Admin\Controllers;

use App\Models\Blog\BlogArticleModel;
use App\Models\Blog\BlogCategoryModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '博客文章';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlogArticleModel());

        $grid->column('id', __('Id'));
        $grid->column('title', __('标题'));
        $grid->column('author', __('作者'));
        $grid->column('summary', __('摘要'));
        $grid->column('cover', __('封面'));
        $grid->column('content', __('内容'));
        $grid->column('like_num', __('点赞数'));
        $grid->column('read_num', __('阅读数'));
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
        $show = new Show(BlogArticleModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('标题'));
        $show->field('author', __('作者'));
        $show->field('summary', __('摘要'));
        $show->field('cover', __('封面'));
        $show->field('content', __('内容'));
        $show->field('like_num', __('点赞数'));
        $show->field('read_num', __('阅读数'));
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
        $form = new Form(new BlogArticleModel());

        $form->text('title', __('标题'))->required();
        $form->textarea('summary', __('摘要'))->required();
        $form->image('cover', __('封面'));
        $form->multipleSelect('cat_id', '博客分类')->options(BlogCategoryModel::all()->pluck('cat_name', 'id'));// 博客分类

        // $form->textarea('content', __('内容'));
        $form->editor('content', __('内容'));

        return $form;
    }
}
