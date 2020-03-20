<?php

namespace App\Admin\Controllers;

use App\Models\Blog\BlogLabelModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LabelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '博客标签';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlogLabelModel());

        $grid->column('id', __('Id'));
        $grid->column('label_name', __('标签名称'));
        $grid->column('is_deleted', __('是否删除'));
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
        $show = new Show(BlogLabelModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('label_name', __('标签名称'));
        $show->field('is_deleted', __('是否删除'));
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
        $form = new Form(new BlogLabelModel());

        $form->text('label_name', __('标签名称'));
        $form->switch('is_deleted', __('是否删除'))->default(1);

        return $form;
    }
}
