<?php

namespace App\Admin\Controllers;

use App\Models\Blog\BlogLabelModel;
use Encore\Admin\Actions\BatchRestore;
use Encore\Admin\Actions\Restore;
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

        $grid->filter(function ($filter){
            $filter->scope('trashed', '回收站')->onlyTrashed();
            $filter->like('label_name', '标签名称');
        });

        $grid->column('id', __('Id'));
        $grid->column('label_name', __('标签名称'));
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
        $show = new Show(BlogLabelModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('label_name', __('标签名称'));
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

        return $form;
    }
}
