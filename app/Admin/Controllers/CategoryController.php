<?php

namespace App\Admin\Controllers;

use App\Models\Blog\BlogCategoryModel;
use Encore\Admin\Actions\BatchRestore;
use Encore\Admin\Actions\Restore;
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

        $grid->filter(function ($filter){
            $filter->scope('trashed', '回收站')->onlyTrashed();
            $filter->like('cat_name', '分类名称');
        });

        $grid->column('id', __('Id'));
        $grid->column('cat_name', __('分类名称'));
        $grid->column('logo', __('分类LOGO'))->image(env('ALIYUN_OSS_ADDRESS'), 30, 30);
        $grid->column('parentCategory.cat_name', __('父级分类'))->replace([''=>'无']);
        $grid->column('level', __('分类级别'))->using([
            0 => '默认',
            1 => '一级分类',
            2 => '二级分类',
            3 => '三级分类',
        ], '未知')->dot([
            0 => 'danger',
            1 => 'info',
            2 => 'primary',
            3 => 'success',
        ], 'warning');
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));
        $grid->column('deleted_at', __('删除时间'));

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
        $show = new Show(BlogCategoryModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('cat_name', __('分类名称'));
        $show->field('logo', __('分类LOGO'))->image(env('ALIYUN_OSS_ADDRESS'), 50, 50);
        $show->field('parent_id', __('父级分类'))->as(function(){
            return $this->parentCategory->cat_name;
        });
        $show->field('level', __('分类级别'))->using([
            0 => '默认',
            1 => '一级分类',
            2 => '二级分类',
            3 => '三级分类',
        ], '未知');
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));
        $show->field('deleted_at', __('删除时间'));

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

        $form->text('cat_name', __('分类名称'))->required();
        $form->image('logo', __('分类LOGO'));
        $form->select('parent_id', __('父级分类'))->options(BlogCategoryModel::selectOptions())->required();
        $form->hidden('level', __('分类级别'))->default(1);

        return $form;
    }

    /**
     * Notes：重写添加分类方法
     * Created by lxj 2020/3/21 15:47
     * @return mixed|void
     */
    public function store()
    {
        // 获取form表单提交数据
        $form_param = \request()->all();

        // 分类级别处理
        $parent_level = BlogCategoryModel::withoutTrashed()->where(['id'=>$form_param['parent_id']])->value('level');
        $level = $parent_level + 1;
        if($parent_level === null){
            $level = 0;
        }
        \request()->offsetSet('level', $level);

        // 父级分类处理
        if($form_param['parent_id'] === null){
            \request()->offsetSet('parent_id', 0);
        }

        return $this->form()->store();
    }
}
