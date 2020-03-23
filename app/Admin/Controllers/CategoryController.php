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
        });
        $grid->column('id', __('Id'));
        $grid->column('cat_name', __('分类名称'));
        $grid->column('logo', __('分类LOGO'));
        $grid->column('parent_id', __('父级分类'));
        $grid->column('level', __('分类级别'));
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
        dd('test');

        $show->field('id', __('Id'));
        $show->field('cat_name', __('分类名称'));
        $show->field('logo', __('分类LOGO'));
        $show->field('parent_id', __('父级分类'));
        $show->field('level', __('分类级别'));
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

        // 查询父级分类列表
        $cat_list = BlogCategoryModel::withoutTrashed()->where('level', '<', 3)
            ->select(['id', 'cat_name'])
            ->get()->keyBy('id');
        $cat_arr = array_column($cat_list->toArray(), 'cat_name', 'id');

        $form->text('cat_name', __('分类名称'))->required();
        $form->image('logo', __('分类LOGO'))->default('vlson_l/images/分类LOGO.png');
        $form->select('parent_id', __('父级分类'))->options($cat_arr)->required();
        $form->hidden('level', __('分类级别'))->default(1);

        return $form;
    }

    /**
     * Notes：重写添加分类方法
     * Created by lxj 2020/3/21 15:47
     * @return mixed|void
     */
    public function store(){
        // 获取form表单提交数据
        $form_param = \request()->all();

        // 分类级别处理
        $parent_level = BlogCategoryModel::withoutTrashed()->where(['id'=>$form_param['parent_id']])->value('level');
        $level = $parent_level + 1;
        if(!$parent_level){
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
