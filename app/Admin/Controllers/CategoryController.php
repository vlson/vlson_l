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
        $grid->column('cat_name', __('Cat name'));
        $grid->column('logo', __('Logo'));
        $grid->column('parent_id', __('Parent id'));
        $grid->column('level', __('Level'));
        $grid->column('is_deleted', __('Is deleted'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show->field('cat_name', __('Cat name'));
        $show->field('logo', __('Logo'));
        $show->field('parent_id', __('Parent id'));
        $show->field('level', __('Level'));
        $show->field('is_deleted', __('Is deleted'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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

        $form->text('cat_name', __('Cat name'));
        $form->text('logo', __('Logo'));
        $form->number('parent_id', __('Parent id'));
        $form->switch('level', __('Level'));
        $form->switch('is_deleted', __('Is deleted'))->default(1);

        return $form;
    }
}
