<?php

namespace App\Admin\Controllers;

use App\Models\Blog\BlogCategoryModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '博客分类';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlogCategoryModel());

        $grid->column('id', __('Id'));
        $grid->column('cat_name', __('分类名称'));
        $grid->column('logo', __('分类LOGO'));
        $grid->column('parent_id', __('父级分类'));
        $grid->column('level', __('分类级别'));
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
        $show = new Show(BlogCategoryModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('cat_name', __('分类名称'));
        $show->field('logo', __('分类LOGO'));
        $show->field('parent_id', __('父级分类'));
        $show->field('level', __('分类级别'));
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
        $form = new Form(new BlogCategoryModel());

        $form->text('cat_name', __('分类名称'));
        $form->text('logo', __('分类LOGO'));
        $form->number('parent_id', __('父级分类'));
        $form->switch('level', __('分类级别'));
        $form->switch('is_deleted', __('是否删除'))->default(1);

        return $form;
    }
}
