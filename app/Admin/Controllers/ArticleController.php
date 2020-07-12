<?php

namespace App\Admin\Controllers;

use App\Models\Blog\BlogArticleModel;
use App\Models\Blog\BlogCategoryModel;
use App\Models\Blog\BlogLabelModel;
use Encore\Admin\Actions\BatchRestore;
use Encore\Admin\Actions\Restore;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '博客文章-后台';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlogArticleModel());

        $grid->filter(function ($filter){
            $filter->scope('trashed', '回收站')->onlyTrashed();
            $filter->like('cat_name', '文章名称');
        });

        $grid->column('id', __('Id'));
        $grid->column('title', __('标题'));
        $grid->column('writer.name', __('作者'));
        $grid->column('summary', __('摘要'));
        $grid->column('cover', __('封面'))->image(env('ALIYUN_OSS_ADDRESS'), 30, 30);
        $grid->column('like_num', __('点赞数'));
        $grid->column('read_num', __('阅读数'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        // 回收站恢复数据
        $grid->actions(function($actions){
            if (\request('_scope_') == 'trashed') {
                $actions->add(new Restore());
            }
        });

        // 回收站批量恢复数据
        $grid->batchActions(function ($batch) {
            if (\request('_scope_') == 'trashed') {
                $batch->add(new BatchRestore());
            }

        });

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

        $show->field('categories', '分类')->as(function ($categories) {
            return $categories->pluck('cat_name');
        })->label();

        $show->field('labels', '标签')->as(function ($labels) {
            return $labels->pluck('label_name');
        })->label();

        $show->field('summary', __('摘要'));
        $show->field('cover', __('封面'));
        $show->field('content', __('内容'))->unescape();
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

        $form->display('id', 'ID');
        $form->text('title', __('标题'))->required();
        $form->hidden('author')->value(Auth::guard('admin')->user()->id);
        $form->textarea('summary', __('摘要'))->required();
        $form->image('cover', __('封面'));
        $form->multipleSelect('categories', '博客分类')->options(BlogCategoryModel::all()->pluck('cat_name', 'id'));// 博客分类

        $form->multipleSelect('labels', '博客标签')->options(BlogLabelModel::all()->pluck('label_name', 'id'));// 博客标签

        $form->editor('content', __('内容'))->required();

        return $form;
    }
}
